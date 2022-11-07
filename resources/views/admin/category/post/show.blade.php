@extends( 'layouts.admin_master' )
@section( 'title', 'Trang quản lý danh mục' )
@section( 'content' )
    <div class="container mt-3">
        <div class="card border-primary">
            <div class="card-header">
                <h2 class="text-center h2">Danh sách bài viết</h2>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div class="text-right my-3">
                        <a href="{{ route('category-posts.index') }}" class="btn btn-sm btn-success"><i class="fa-solid fa-backward"></i></a>
                    </div>
                    <div class="">
                        <h2 class="h3">Category name: <span> {{ $category->name }} </span></h2>
                    </div>
                    <table
                        class="mt-2 table table-striped
                    table-hover
                    table-borderless
                    table-primary
                    align-middle">
                        <thead class="table-light">
                            <tr class="bg-danger">
                                <th>ID</th>
                                <th>Post Title</th>
                                <th>Content</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            @foreach ($category->posts as $post)
                                <tr class="table-primary">
                                    <td scope="row">{{ $post->id }}</td>
                                    <td scope="row" class="w-25">{{ $post->title }}</td>
                                    <td scope="row" class="w-50">{!! $post->content !!}</td>
                                    <td><a href="" class="btn btn-sm btn-primary">Xem bài viết</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
