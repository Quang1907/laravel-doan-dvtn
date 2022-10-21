@extends('layouts.admin_master')
@section("title", "Page Admin")
@section('content')
    <div class="container">
        <h2 class="text-2xl mt-4 mb-2">Thay đổi carousel</h2>
        <form action="{{ route( 'carousel' ) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="input-group">
                <span class="input-group-btn">
                <a id="lfm" data-input="thumbnail2" data-preview="holder2" class="btn btn-primary text-white">
                    <i class="fa fa-picture-o"></i> Choose
                </a>
                </span>
                <input id="thumbnail2" class="form-control" type="text" name="image" multiple>
            </div>
            <div id="holder2" class="flex" style="margin-top:15px;max-height:100px;"></div>
            <div class="mt-3">
                <button type="submit" class="btn btn-primary bg-primary">Save</button>
            </div>
        </form>
    </div>

@endsection
@section('script')
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script>
 $('#lfm').filemanager('image');
</script>
@endsection
