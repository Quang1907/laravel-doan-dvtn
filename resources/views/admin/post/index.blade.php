@extends('layouts.admin_master')
@section('title', 'trang quan ly bai viet')
@section('content')
    <div class="container mt-3">
        <div class="card border-primary">
            <div class="card-header">
                <h2 class="text-center">List Posts</h2>
            </div>
            <div class="card-body">
                <div class="table">
                    <div class="row">
                        <div class="col-sm-12 col-md-9">
                            <form action="" method="get">
                                <div class="dt-buttons btn-group flex-wrap">
                                    <div class="mt-3 px-1">
                                        <div class="input-group">
                                            <input type="search" name="search" class="form-control rounded-0 px-2"
                                                value="{{ request('search') }}" placeholder="Search post name"
                                                aria-controls="example1">
                                        </div>
                                    </div>
                                    <div class="form-group mt-3 px-1">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                            </div>
                                            <input type="date" value="{{ request('date') }}" name="date" class="form-control"
                                                data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy"
                                                data-mask="" inputmode="numeric">
                                        </div>
                                    </div>
                                    <div class="mt-3 px-1">
                                        <div class="input-group">
                                            <select name="category_id" class="form-control rounded-0" id="">
                                                <option value="" selected disabled>Choose a category</option>
                                                @foreach ( $categories as $category )
                                                    <option @if ( $category->id == request('category_id') ) selected @endif value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-primary mt-0">Search</button>
                                        <a href="{{ route('post.index') }}" class="btn btn-success mt-0">Reset</a>
                                        <button onclick="showImport()" type="button"
                                            class="text-white btn btn-warning mt-0">
                                            <i class="fas fa-plus"></i>
                                            <span>Add files</span>
                                        </button>
                                        <a href="{{ route( 'post.export' ) }}" class="btn btn-info">Export</a>
                                    </div>
                                </div>
                            </form>
                            <div id="showFormImport" class="mb-3">
                                <form id="formImport" action="{{ route('post.import') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="m-3">
                                        <div class="progress rounded-pill">
                                            <div class="progress-bar bg-warning" role="bar" style="width: 0%"
                                                aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                                                <p class="precent m-2">0%</p>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="file" name="upload_file" accept=".xlsx">
                                    <button class="btn btn-success" type="submit">Start</button>
                                </form>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-3 mt-3 text-right">
                            @can( 'create', App\Models\Post::class )
                                <a href="{{ route('post.create') }}" class="btn btn-success"><i
                                        class="fa-solid fa-plus"></i></a>
                            @endcan
                        </div>
                    </div>
                    <table
                        class="table table-striped
                    table-hover
                    table-borderless
                    table-primary
                    align-middle">
                        <thead class="table-light">
                            <tr class="bg-danger">
                                <th>ID</th>
                                <th>Image</th>
                                <th>Post name</th>
                                <th>List Caetgory</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider ">
                            @foreach ( $posts as $post )
                                <tr class="table-primary">
                                    <td scope="row">{{ $post->id }}</td>
                                    <td scope="row">
                                        @if ( stripos( $post->image,  "drive.google.com" ) )
                                            <img src="{{ $post->image }}"  width="70px" alt="">
                                        @else
                                            <img src="{{ asset( "storage/" . $post->image ) }}"  width="70px" alt="">
                                        @endif
                                    </td>
                                    <td scope="row" class="">{{ $post->title }}</td>
                                    <td>
                                        <ul>
                                            @foreach ( $post->categories as $category )
                                                <li>
                                                    {{ $category->name }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td class="w-25">
                                        <form action="{{ route('post.destroy', $post->id) }}" method="post" id="formDelete">
                                            @csrf
                                            @method('DELETE')
                                            @can('view', $post)
                                                <a href="{{ route('post.show', $post->id) }}" class="btn btn-primary">Detail</a>
                                            @endcan
                                            @can('update', $post)
                                                <a href="{{ route('post.edit', $post->id) }}" class="btn btn-warning">Edit</a>
                                            @endcan
                                            @can('delete', $post)
                                                <button type="submit" class="btn btn-danger" onclick="btnDeletePost()" >Delete</button>
                                            @endcan
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $posts->appends(request()->all())->links('vendor.pagination.bootstrap') }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $("#showFormImport").toggle();

        function showImport() {
            $("#showFormImport").toggle();
        }

        function btnDeletePost() {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if ( result.isConfirmed ) {
                    $("#formDelete").submit();
                }
            })
        }

        $(document).ready(function() {
            var bar = $(".progress-bar");
            var precent = $(".precent");

            $("#formImport").ajaxForm({
                beforeSend:function () {
                    var precentValue = "0%";
                    bar.width( precentValue );
                    precent.html( precentValue );
                },

                uploadProgress:function ( event, position, total, precentComplete) {
                    var precentValue = precentComplete + "%";
                    bar.width( precentValue );
                    precent.html( precentValue );

                },

                complete:function ( res ) {
                    if ( confirm( "You are upload successfully, We will send notification after imported finish" ) ) {
                        $("#showFormImport").toggle();
                        var precentValue = "0%";
                        bar.width( precentValue );
                        precent.html( precentValue );
                    }
                }
            });
        })
    </script>
@endsection
