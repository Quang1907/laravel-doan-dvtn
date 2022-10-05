@extends('layouts.admin_master')
@section('title', 'Edit post')
@section('content')
    <div class="container mt-3">
        <div class="card border-primary">
            <div class="card-header">
                <h2 class="text-center">Edit Post</h2>
            </div>
            <div class="card-body">
                @if (\Session::has('message'))
                    <div class="alert alert-success text-center">
                        <ul class="m-0">
                            <li class="list-unstyled">{!! \Session::get('message') !!}</li>
                        </ul>
                    </div>
                @endif
                <div class="text-right my-3">
                    <a href="{{ route('post.index') }}" class="btn btn-success"><i class="fa-solid fa-backward"></i></a>
                </div>
                <div class="mt-5 col-sm-4 mx-auto">
                    <form action="{{ route('post.update', $post ) }}" method="post">
                        @method("put")
                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-label">Post Name</label>
                            <input type="text" class="form-control" name="title" value="{{ old( "title", $post->title ) }}" id=""
                                placeholder="Tên danh mục">
                            <span class="text-danger">{{ $errors->first('title') }}</span>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Post content</label>
                            <textarea class="form-control" name="content" id="" cols="30" rows="10">{{ old( "content", $post->content ) }}</textarea>
                            <span class="text-danger">{{ $errors->first('content') }}</span>
                        </div>
                        <div>
                            <?php
                            $cateArr = [];
                            foreach ( $post->categories as $category ) {
                                array_push( $cateArr, $category->id );
                            }
                            ?>
                            <select class="category form-control" name="category_id[]" multiple="multiple">
                                @foreach ($categories as $category)
                                    <option @if ( in_array( $category->id, old( "category_id", $cateArr ) ) ) {{ "selected" }} @endif  value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger">{{ $errors->first('category_id') }}</span>
                        </div>
                        <div class="m-3">
                            <button type="submit" class="btn btn-success float-end">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('.category').select2();
        });
    </script>
@endsection
