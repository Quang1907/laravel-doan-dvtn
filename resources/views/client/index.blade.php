@extends( "layouts.client_master" )
@section( "title", "Trang chu" )

@section( "content" )
    <textarea id="my-editor" name="content" class="form-control">{!! old('content') !!}</textarea>
@endsection

@section('script')
    <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
    <script>
        var options = {
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
        };
        CKEDITOR.replace('my-editor', options);
    </script>
@endsection
