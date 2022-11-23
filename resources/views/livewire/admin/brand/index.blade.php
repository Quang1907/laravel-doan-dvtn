<div>
    @include( "livewire.admin.brand.modal-form" )
    <div class="card m-4">
        <div class="card-header rounded d-flex justify-between">
            <div class="w-100">
                <h2 class="h2">Brand</h2>
            </div>
            <div class="w-100 text-right">
                <a href="#" data-bs-toggle="modal" data-bs-target="#brandModal" class="btn text-white btn-primary btn-sm">Add Brand</a>
            </div>
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
                            <th scope="col">Category</th>
                            <th scope="col">Status</th>
                            <th scope="col" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ( $brands as $brand )
                            <tr>
                                <td class="p-1">{{ $brand->id }}</td>
                            <td class="p-1">{{ $brand->name }}</td>
                            <td class="p-1">{{ $brand->category_products->name }}</td>
                            <td class="p-1">{{ $brand->status == 1 ? "Visiblae" : "Hidden" }}</td>
                            <td class="w-25 text-center p-1">
                                <a href="#" wire:click.prevent="editBrand({{ $brand->id }})" data-bs-toggle="modal" data-bs-target="#updateBrandModal" class="btn btn-sm btn-warning bg-warning text-white">Edit</a>
                                <a href="#" wire:click.prevent="deleteBrand({{ $brand->id }})" data-bs-toggle="modal" data-bs-target="#deleteBrandModal"  class="btn btn-sm btn-danger bg-danger text-white">Delete</a>
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

