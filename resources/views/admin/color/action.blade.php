@extends( 'layouts.admin_master' )
@section('title',  empty( $color ) ? 'Create Color' : 'Edit Color' )
@section('content')
    <div class="card row m-4">
        <div class="card-header rounded row justify-between">
            <h2 class="h2">@yield( "title" )</h2>
            <a href="{{ route('color.index') }}" class="btn text-white btn-warning float-end btn-sm">Back</a>
        </div>
        <div class="card-body">
            <x-message />
            <div class="table-responsive">
                @if ( !empty( $color ) )
                    <form action="{{ route( "color.update", $color ) }}" method="POST">
                    @method( "PUT" )
                @else
                    @php( $color = [] )
                    <form action="{{ route( "color.store" ) }}" method="POST">
                    @method( "POST" )
                @endif

                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{ old( 'name', $color ? $color->name : "" ) }}">
                        @error( "name" )
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="code" class="form-label">Code</label>
                        <input type="text" class="form-control" name="code" id="code" value="{{ old( 'code', $color ? $color->code : "" ) }}">
                        @error( "code" )
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-check form-check-success">
                        <label class="form-check-label">
                            <input type="checkbox" name="status" class="form-check-input" @if( old( 'status', $color ? $color->status : "" ) == 1 ) checked @endif>
                            <i class="input-helper"></i>
                            Success
                        </label>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary bg-primary float-right text-white">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
