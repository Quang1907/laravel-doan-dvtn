@extends( 'layouts.admin_master' )
@section('title', 'Sliders')
@section('content')
    <div class="card m-4">
        <div class="card-header rounded d-flex">
            <div class="w-100">
                <h2 class="h2">Sliders</h2>
            </div>
            <div class="w-100 text-right">
                <a href="{{ route('slider.create') }}" class="btn text-white btn-primary btn-sm">Add Slider</a>
            </div>
        </div>
        <div class="card-body">
            <x-message />
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Description</th>
                            <th class="text-center">Status</th>
                            <th width="250px" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ( $sliders as $slider )
                            <tr>
                                <td>{{ $slider->id }}</td>
                                <td>{{ $slider->title }}</td>
                                <td>
                                    <div class="position-relative mr-3">
                                      <img class="rounded-circle overflow-hidden" width="50px" height="50px" src="{{ asset( $slider->image )}}" alt="User Image">
                                    </div>
                                </td>
                                <td>{{ $slider->description }}</td>
                                <td class="text-center my-auto">
                                    <i class="@if ( $slider->status ) text-success @else text-danger @endif fa-regular fa-circle-dot"></i>
                                </td>
                                <td class="text-center">
                                    <form action="{{ route( 'slider.destroy', $slider ) }}" method="post">
                                        @csrf
                                        @method( "DELETE" )
                                        <a href="{{ route( 'slider.edit', $slider ) }}" class="btn btn-sm btn-warning text-white">Edit</a>
                                        <button type="submit" class="btn btn-sm btn-danger bg-danger text-white" onclick="return confirm( 'Are you sure, you want to delete this data?');">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                        <tr>
                            <td colspan="7">No Sliders Available</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="d-flex justify-content-center mt-3">
                    {{ $sliders->appends(request()->all())->links('vendor.pagination.bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
@endsection
