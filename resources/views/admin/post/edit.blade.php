@extends('layouts.admin_master')
@section('title', 'Chỉnh sửa bài viết')

@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
    <div class="container mt-3">
        <div class="card border-primary">
            <div class="card-header">
                <h2 class="text-center text-2xl font-bold">Chỉnh sửa bài viết</h2>
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
                    <a href="{{ route('post.index') }}" class="btn btn-sm btn-success"><i class="fa-solid fa-backward"></i></a>
                </div>
                <div class="mt-5 mx-auto">
                    <form action="{{ route('post.update', $post ) }}" method="post" enctype="multipart/form-data">
                        @method("put")
                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-label">Post Name</label>
                            <input type="text" class="form-control" name="title" value="{{ old( "title", $post->title ) }}" id=""
                                placeholder="Tên danh mục">
                            <span class="text-danger">{{ $errors->first('title') }}</span>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Image</label>
                            <div class="custom-file">
                                <div>
                                    <input type="file" accept="image/*" class="custom-file-input"  id="customFile" name="image"
                                    value="{{ old('image',  $post->image) }}">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                    <span class="text-danger">{{ $errors->first('image') }}</span>
                                </div>
                                <div class="mt-3">
                                    <label class="switch switch-secondary switch-pill form-control-label mr-2">
                                        <input type="checkbox" class="switch-input form-check-input" name="googleDrive">
                                        <span class="switch-label"></span>
                                        <span class="switch-handle"></span>
                                    </label>
                                    Upload image to google drive
                                </div>
                            </div>
                            <div class="text-center">
                                @if ( stripos( $post->image,  "drive.google.com" ) )
                                    <img class="mt-4" src="{{  old('image', $post->image ) }}" width="150px" alt="image description" id="showimage">
                                @else
                                    <img class="mt-4" src="{{  asset( "storage/" . old('image', $post->image ) ) }}" width="150px" alt="image description" id="showimage">
                                @endif
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Post content</label>
                            <textarea id="content" name="content" class="form-control">{!! old('content', $post->content ) !!}</textarea>
                            <span class="text-danger">{{ $errors->first('content') }}</span>
                        </div>

                        <div class="mb-3 mx-3 d-flex">
                            <div class="custom-control custom-checkbox checkbox-success d-inline-block mr-3 mb-3">
                                <input type="checkbox" class="custom-control-input" id="trending_post" @if ( $post->trending_post == true ) checked @endif name="trending_post">
                                <label class="custom-control-label" for="trending_post">Treding</label>
                            </div>

                            <div class="custom-control custom-checkbox checkbox-success d-inline-block mr-3 mb-3">
                                <input type="checkbox" class="custom-control-input" id="hot_news" @if ( $post->trending_post == true ) checked @endif name="hot_news">
                                <label class="custom-control-label" for="hot_news">Hot News</label>
                            </div>

                            <div class="custom-control custom-checkbox checkbox-success d-inline-block mr-3 mb-3">
                                <input type="checkbox" class="custom-control-input" id="popular_post" @if ( $post->trending_post == true ) checked @endif name="popular_post">
                                <label class="custom-control-label" for="popular_post">Popular</label>
                            </div>
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
                            <button type="submit" class="btn btn-sm btn-success bg-success float-right">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.category').select2();
            var select = $(".select2-selection__choice")
            select.css( "color", "black" );
            select.css( "padding-left", "30px" );
            $(".select2-search__field").addClass("border-0");

            $('.category').change( function () {
                $(".select2-selection__choice").css( "color", "black" );
                $(".select2-selection__choice").css( "padding-left", "30px" );
            });
        });


        $(".custom-file-input").on("change", function() {
          var fileName = $(this).val().split("\\").pop();
          $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
          $("#showimage").removeClass( "d-none" );
          readURL(this);
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showimage').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        var options = {
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
        };
        CKEDITOR.replace('content', options);
    </script>
@endsection
