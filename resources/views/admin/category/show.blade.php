@extends( 'layouts.admin_master' )
@section( 'title', 'trang quan ly danh muc' )
@section( 'content' )
    <div class="container mt-3">
        <div class="card border-primary">
            <div class="card-header">
                <h2 class="text-center">List Posts In Category</h2>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div class="text-right my-3">
                        <a href="{{ route('category.index') }}" class="btn btn-success"><i class="fa-solid fa-backward"></i></a>
                    </div>
                    <div class="">
                        <h2>Category name: <span> {{ $category->name }} </span></h2>
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
                                <th>Post Title</th>
                                <th>Content</th>
                                {{-- <th>Action</th> --}}
                            </tr>
                        </thead>
                        <tbody class="table-group-divider ">
                            @foreach ($category->posts as $post)
                                <tr class="table-primary">
                                    <td scope="row">{{ $post->id }}</td>
                                    <td scope="row" class="w-25">{{ $post->title }}</td>
                                    <td scope="row" class="w-50">{{ $post->content }}</td>
                                    {{-- <td class="w-25">
                                        <form action="{{ route('post.destroy', $post->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                             <a href="{{ route('post.show', $post->id) }}"
                                                class="btn btn-primary">List
                                                Posts</a>
                                            <a href="{{ route('post.edit', $post->id) }}"
                                                class="btn btn-warning">Edit</a>
                                            <button class="btn btn-danger">Delete</button>
                                        </form>
                                    </td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
