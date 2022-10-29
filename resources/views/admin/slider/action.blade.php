@extends( 'layouts.admin_master' )
@section('title',  empty( $slider ) ? 'Create Slider' : 'Edit Slider' )
@section('content')
    <div class="card m-4">
        <div class="card-header rounded d-flex">
            <div class="w-100">
                <h2 class="h2">@yield( "title" )</h2>
            </div>
            <div class="w-100 text-right">
                <a href="{{ route('slider.index') }}" class="btn text-white btn-primary btn-sm">Back</a>
            </div>
        </div>
        <div class="card-body">
            <x-message />
            <div class="table-responsive">
                @if ( !empty( $slider ) )
                    <form action="{{ route( "slider.update", $slider ) }}" method="POST" enctype="multipart/form-data">
                    @method( "PUT" )
                @else
                    @php( $slider = [] )
                    <form action="{{ route( "slider.store" ) }}" method="POST" enctype="multipart/form-data">
                    @method( "POST" )
                @endif

                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" name="title" id="title" value="{{ old( 'title', $slider ? $slider->title : "" ) }}">
                        @error( "title" )
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleTextarea1">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="4">{{ old( 'description', $slider ? $slider->description : ""  ) }}</textarea>
                        @error( 'description' ) <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="input-group">
                        <span class="input-group-btn">
                        <a id="lfm" data-input="thumbnail2" data-preview="holder2" class="btn btn-sm btn-primary text-white">
                            <i class="fa fa-picture-o"></i> Choose
                        </a>
                        </span>
                        <input id="thumbnail2" class="form-control" type="hidden" value="{{ old( 'image', $slider ? $slider->image : ""  ) }}" name="image" multiple>
                        <div class="w-100">
                            @error( 'image' ) <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>
                    <div id="holder2" class="flex" style="margin-top:15px;max-height:100px;">
                        @if ( !empty( $slider->image ) )
                            <img src="{{ asset(  $slider->image ) }}" width="50px" class="img-fluid rounded-top" alt="">
                        @endif
                    </div>
                    <div class="mt-4">
                        <div class="custom-control custom-checkbox checkbox-success d-inline-block mr-3 mb-3">
                            <input type="checkbox" name="status" class="custom-control-input" id="customCheckSuccess"@if( old( 'status', $slider ? $slider->status : "" ) == 1 ) checked @endif>
                            <label class="custom-control-label" for="customCheckSuccess">Status</label>
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary btn-sm bg-primary float-right text-white">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script>
    $('#lfm').filemanager('image');
    </script>
@endsection
