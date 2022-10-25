@extends( 'layouts.admin_master' )
@section('title', 'Colors')
@section('content')
    <div class="card row m-4">
        <div class="card-header rounded row justify-between">
            <h2 class="h2">Colors</h2>
            <a href="{{ route('color.create') }}" class="btn text-white btn-warning float-end btn-sm">Add Color</a>
        </div>
        <div class="card-body ">
            <x-message />
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Code</th>
                            <th>Status</th>
                            <th width="250px" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ( $colors as $color )
                            <tr>
                                <td>{{ $color->id }}</td>
                                <td>{{ $color->name }}</td>
                                <td>{{ $color->code }}</td>
                                <td>{{ $color->status ? "Visiable" : "Hidden" }}</td>
                                <td class="text-center">
                                    <form action="{{ route( 'color.destroy', $color ) }}" method="post">
                                        @csrf
                                        @method( "DELETE" )
                                        <a href="{{ route( 'color.edit', $color ) }}" class="btn btn-warning text-white">Edit</a>
                                        <button type="submit" class="btn btn-danger bg-danger text-white" onclick="return confirm( 'Are you sure, you want to delete this data?');">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                        <tr>
                            <td colspan="7">No Colors Available</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="d-flex justify-content-center mt-3">
                    {{ $colors->appends(request()->all())->links('vendor.pagination.bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
@endsection
