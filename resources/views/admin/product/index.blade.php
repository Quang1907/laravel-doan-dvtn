@extends( 'layouts.admin_master' )
@section('title', 'List Products')
@section('content')
    <div class="card">
        <div class="card-header rounded d-flex">
            <div class="w-100">
                <h2 class="h2">List Products</h2>
            </div>
            <div class="w-100 text-right">
                <a href="{{ route('product.create') }}" class="btn text-white btn-warning btn-sm">Add Product</a>
            </div>
        </div>
        <div class="card-body">
            <x-message />
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Category</th>
                            <th>Brand</th>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Status</th>
                            <th width="250px" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ( $products as $product )
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>
                                    {{ $product->category_products->name }}
                                </td>
                                <td>
                                    {{ $product->productBrand->name ?? "no brand" }}
                                </td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->original_price }}</td>
                                <td>{{ $product->quantity }}</td>
                                <td>{{ $product->status ? "Visible" : "Hidden" }}</td>
                                <td>
                                    <form action="{{ route( 'product.destroy', $product ) }}" method="post">
                                        @csrf
                                        @method( "DELETE" )
                                        <a href="{{ route( 'product.edit', $product ) }}" class="btn btn-sm btn-sm btn-warning bg-warning text-white">Edit</a>
                                        <button type="submit" class="btn btn-sm btn-danger btn-sm bg-danger text-white" onclick="return confirm( 'Are you sure, you want to delete this data?');">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                        <tr>
                            <td colspan="7">No Products Available</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="d-flex justify-content-center mt-3">
                    {{ $products->appends(request()->all())->links('vendor.pagination.bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
@endsection
