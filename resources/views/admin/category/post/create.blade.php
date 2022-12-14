@extends( 'layouts.admin_master' )
@section( 'title', 'Create Category' )
@section( 'content' )
    <div class="container mt-3">
        <div class="card border-primary">
            <div class="card-header">
                <h2 class="text-center h2">@yield( "title" )</h2>
            </div>
            <div class="card-body">
                <div class="text-right my-3">
                    <a href="{{ route( 'category-posts.index' ) }}" class="btn btn-sm btn-success"><i class="fa-solid fa-backward"></i></a>
                </div>
                @if (\Session::has('message'))
                    <div class="alert alert-success text-center">
                        <ul class="m-0">
                            <li class="list-unstyled">{!! \Session::get('message') !!}</li>
                        </ul>
                    </div>
                @endif

                <div class="mt-5 col-sm-4 mx-auto">
                    <form action="{{ route( 'category-posts.store' ) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-label">Category Name</label>
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}" id="" placeholder="Tên danh mục">
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="exampleTextarea1">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="4">{{ old( 'description' ) }}</textarea>
                            @error( 'description' ) <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="input-group">
                            <span class="input-group-btn">
                            <a id="lfm" data-input="thumbnail2" data-preview="holder2" class="btn btn-sm btn-primary text-white">
                                <i class="fa fa-picture-o"></i> Choose
                            </a>
                            </span>
                            <input id="thumbnail2" class="form-control" type="hidden" value="{{ old( 'image' ) }}" name="image" multiple>
                        </div>
                        <div id="holder2" class="flex" style="margin-top:15px;max-height:100px;"></div>
                        <div class="col-sm-6 mt-4">
                            <div class="custom-control custom-checkbox checkbox-success d-inline-block mr-3 mb-3">
                                <input type="checkbox" name="status" class="custom-control-input" id="customCheckSuccess" {{ ( old( 'status' ) == "on" ) ? "checked" : "" }}>
                                <label class="custom-control-label" for="customCheckSuccess">Status</label>
                            </div>
                        </div>
                        <div class="m-3">
                            <h2>Seo Tags</h2>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Meta Title</label>
                            <input type="text" class="form-control" name="meta_title" id="" value="{{ old( 'meta_title' ) }}">
                            @error( 'meta_title' ) <span class="text-danger">{{ $message }}</span> @enderror

                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Meta Keyword</label>
                            <textarea class="form-control" id="description" name="meta_keyword" rows="4">{{ old( 'meta_keyword' ) }}</textarea>
                            @error( 'meta_keyword' ) <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Meta Description</label>
                            <textarea class="form-control" id="description" name="meta_description" rows="4">{{ old( 'meta_description' ) }}</textarea>
                            @error( 'meta_description' ) <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-sm btn-success bg-success float-end">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section( 'script' )
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script>
        $('#lfm').filemanager('image');
    </script>
@endsection
