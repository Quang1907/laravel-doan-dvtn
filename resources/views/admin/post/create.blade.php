@extends('layouts.admin_master')
@section('title', 'trang quan ly danh muc')
@section('content')
    <div class="container mt-3">
        <div class="card border-primary">
            <div class="card-header">
                <h2 class="text-center">Create Post</h2>
            </div>
            <div class="card-body">
                @if (\Session::has('message'))
                    <div class="alert alert-success text-center">
                        <ul class="m-0">
                            <li class="list-unstyled">{!! \Session::get('message') !!}</li>
                        </ul>
                    </div>
                @endif
                <div class="text-right">
                    <a href="{{ route('post.index') }}" class="btn btn-success"><i class="fa-solid fa-backward"></i></a>
                </div>
                <div class="mt-3 mx-auto">
                    <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-label">Post Name</label>
                            <input type="text" class="form-control" name="title" id=""
                                placeholder="Enter post title" value="{{ old('title') }}">
                            <span class="text-danger">{{ $errors->first('title') }}</span>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Image</label>
                            <div class="custom-file">
                                <div>
                                    <input type="file" accept="image/*" class="custom-file-input"  id="customFile" name="image" value="{{ old('image') }}">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                    <span class="text-danger">{{ $errors->first('image') }}</span>
                                </div>
                                <div>
                                    <input type="checkbox" name="googleDrive" id="googleDrive">
                                    <label for="googleDrive">Upload image to google drive</label>
                                </div>
                            </div>
                            <div class="text-center">
                                <img class="d-none mt-4" src="" width="150px" alt="image description" id="showimage">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Post content</label>
                            <textarea id="my-editor" name="content" class="form-control">{!! old('content') !!}</textarea>
                            <span class="text-danger">{{ $errors->first('content') }}</span>
                        </div>
                        <div>
                            <label for="" class="form-label">Category name</label>
                            <select class="category form-control border-0" name="category_id[]" multiple="multiple">
                                @foreach ( $categories as $category )
                                    <option  @if ( in_array( $category->id, old( "category_id" , [] ) ) ) selected @endif value="{{ $category->id }}">{{ $category->name }}</option>
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
    <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
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
        CKEDITOR.replace('my-editor', options);
    </script>
@endsection
