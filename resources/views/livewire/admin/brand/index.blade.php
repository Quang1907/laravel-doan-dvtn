<div>
    @include( "livewire.admin.brand.modal-form" )
    <div class="card m-4">
        <div class="card-header rounded d-flex justify-between">
            <h2 class="h2">Brand</h2>
            <a href="#" class="btn text-white btn-primary float-end btn-sm"  data-bs-toggle="modal" data-bs-target="#brandModal">Add Brand</a>
        </div>
        <div class="card-body">
            @if ( session( "message" ) )
                <div class="alert alert-success w-100" role="alert">
                    <h2> {{ session( "message" ) }} </h2>
                </div>
            @endif
            <div class="table-responsive">
                <table class="table table-primary table-bordered table-striped">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Status</th>
                            <th scope="col" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ( $brands as $brand )
                            <tr class="">
                                <td>{{ $brand->id }}</td>
                                <td>{{ $brand->name }}</td>
                                <td>{{ $brand->status == 1 ? "Visiblae" : "Hidden" }}</td>
                                <td class="w-25 text-center">
                                    <a href="#" wire:click.prevent="editBrand({{ $brand->id }})" data-bs-toggle="modal" data-bs-target="#updateBrandModal" class="btn btn-warning bg-warning text-white">Edit</a>
                                    <a href="#" wire:click.prevent="deleteBrand({{ $brand->id }})" data-bs-toggle="modal" data-bs-target="#deleteBrandModal"  class="btn btn-danger bg-danger text-white">Delete</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">No brands Found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="d-flex justify-content-center mt-4">
                    {{ $brands->links() }}
                </div>
            </div>
        </div>
    </div>
</div>


@section( "script" )
    <script>
        window.addEventListener( "close-modal", event => {
            event.preventDefault();
            $( "#brandModal" ).modal( "hide" );
            $( "#updateBrandModal" ).modal( "hide" );
            $( "#deleteBrandModal" ).modal( "hide" );
        } );
    </script>
@endsection

