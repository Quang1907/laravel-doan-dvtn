@extends( 'layouts.admin_master' )
@section('title', 'Edit Product')
@section('content')
    <div class="card">
        <div class="card-header rounded row justify-between">
            <h2 class="h2">Change Product</h2>
            <a href="{{ route('product.index') }}" class="btn text-white btn-warning float-end btn-sm">Back</a>
        </div>
        <div class="card-body">
            <x-errors.any />
            <x-message />
            <form action="{{ route( 'product.update', $product ) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method("PUT")
                <!-- Nav tabs -->
                <ul class="nav nav-tabs border-0 border-bottom" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home"
                            type="button" role="tab" aria-controls="home" aria-selected="true">Home</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="seo-tag-tab" data-bs-toggle="tab" data-bs-target="#seo-tag" type="button"
                            role="tab" aria-controls="seo-tag" aria-selected="false">SEO Tags</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="detail-tab" data-bs-toggle="tab" data-bs-target="#detail"
                            type="button" role="tab" aria-controls="detail" aria-selected="false">Details</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="product-image-tab" data-bs-toggle="tab" data-bs-target="#product-image"
                            type="button" role="tab" aria-controls="product-image" aria-selected="false">Product Image</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="product-color-tab" data-bs-toggle="tab" data-bs-target="#product-color"
                            type="button" role="tab" aria-controls="product-color" aria-selected="false">Product Color</button>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane border p-3 active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="mb-3">
                            <label for="" class="form-label">Select Category</label>
                            <select class="form-control" name="category_id" id="">
                                <option selected>Choose an category</option>
                                @forelse ( $categories as $category )
                                    <option value="{{ $category->id }}" @if ( old( 'category_id', $product->category_id ) == $category->id ) selected @endif >{{ $category->name }}</option>
                                @empty
                                    <option >Category not found</option>
                                @endforelse
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Product Name</label>
                            <input type="text"
                            class="form-control" name="name" value="{{ old( 'name', $product->name ) }}" id="name">
                        </div>
                        <div class="mb-3">
                            <label for="slug" class="form-label">Product Slug</label>
                            <input type="text"
                            class="form-control" name="slug" value="{{ old( 'slug', $product->slug ) }}"  id="slug">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Select Brand</label>
                            <select class="form-control" name="brand" id="">
                                <option selected>Choose an brand</option>
                                @forelse ( $brands as $brand )
                                    <option value="{{ $brand->id }}" @if ( old( 'brand', $product->brand ) == $brand->id ) selected @endif >{{ $brand->name }}</option>
                                @empty
                                    <option >Brand not found</option>
                                @endforelse
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="small_description" class="form-label">Small Description( 500 words )</label>
                            <textarea class="form-control" name="small_description" id="small_description" rows="4">{{ old( 'small_description', $product->small_description ) }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" name="description" id="description" rows="4">{{ old( 'description', $product->description ) }}</textarea>
                        </div>
                    </div>
                    <div class="tab-pane fade border p-3" id="seo-tag" role="tabpanel" aria-labelledby="seo-tag-tab">
                        <div class="mb-3">
                        <label for="meta_title" class="form-label">Meta Title</label>
                        <input type="text" class="form-control" name="meta_title" id="meta_title" value="{{ old( 'meta_title', $product->meta_title ) }}" >
                        </div>
                        <div class="mb-3">
                            <label for="meta_description" class="form-label">Meta Keyword</label>
                            <textarea class="form-control" name="meta_description" id="meta_description" rows="4">{{ old( 'meta_description', $product->meta_description ) }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="meta_keyword" class="form-label">Meta Description</label>
                            <textarea class="form-control" name="meta_keyword" id="meta_keyword" rows="4">{{ old( 'meta_keyword', $product->meta_keyword ) }}</textarea>
                        </div>
                    </div>
                    <div class="tab-pane fade border p-3" id="detail" role="tabpanel" aria-labelledby="detail-tab">
                        <div class="row">
                            <div class="mb-3 col-sm-4">
                                <label for="original_price" class="form-label">Original Price</label>
                                <input type="number"
                                class="form-control" name="original_price" value="{{ old( 'original_price', $product->original_price ) }}"  id="original_price">
                            </div>
                            <div class="mb-3 col-sm-4">
                                <label for="selling_price" class="form-label">Selling Price</label>
                                <input type="number" class="form-control" value="{{ old( 'selling_price', $product->selling_price ) }}" name="selling_price" id="selling_price">
                            </div>
                            <div class="mb-3 col-sm-4">
                                <label for="quantity" class="form-label">Quantity</label>
                                <input type="number" class="form-control" value="{{ old( 'quantity', $product->quantity ) }}" name="quantity" id="quantity">
                            </div>
                            <div class="mb-3 mx-3 d-flex">
                                <div class="form-check px-2">
                                    <div class="form-check form-check-success">
                                        <label class="form-check-label">
                                          <input type="checkbox" class="form-check-input" @if ( old( 'trending', $product->trending ) ) checked @endif name="trending">
                                          Trending
                                        <i class="input-helper"></i></label>
                                    </div>
                                </div>
                                <div class="form-check px-5">
                                    <div class="form-check form-check-success">
                                        <label class="form-check-label">
                                          <input type="checkbox" class="form-check-input" @if ( old( 'status', $product->status ) ) checked @endif name="status">
                                          Status
                                        <i class="input-helper"></i></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade border p-3" id="product-image" role="tabpanel" aria-labelledby="product-image-tab">
                        <div class="mb-3">
                            <label for="imageFile" class="form-label">Upload Product Images</label>
                            <input type="file" class="form-control" name="imageFile[]" id="imageFile" multiple>
                            <div class="row">
                                <div class="col-sm-1">
                                    @foreach ( $product->productImages as $productImage )
                                        <img src="{{ asset( $productImage->image ) }}" width="100px" height="100px" class=" mt-3 img-thumbnail rounded-top border-2" alt="">
                                        <a href="{{ route( 'product-image.delete', $productImage )}}" class="d-block text-center"><i class="mdi mdi-close"></i></a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade border p-3 fw-bold" id="product-color" role="tabpanel" aria-labelledby="product-color-tab">
                        <div class="mb-3">
                            <label for="" class="form-label">Color</label>
                            <div class="row" id="colors">
                                @forelse ( $product_colors as $product_color )
                                <div class="col-sm-3 border text-white" style="background-color: {{ $product_color->code }}">
                                        <div class="mt-2 custom-control custom-checkbox checkbox-secondary d-inline-block mr-3">
                                            <input type="checkbox"  value="{{ $product_color->id }}" name="colors[{{ $product_color->id }}]" checked class="custom-control-input" id="label-{{$product_color->id}}">
                                            <label class="custom-control-label" for="label-{{$product_color->id}}">{{ $product_color->name }}</label>
                                        </div>
                                    <label class="mt-1 p-2">
                                        Quantity
                                        <input type="number" class="form-control" name="color_quantity[{{  $product_color->id }}]" value="{{ $product_color->pivot->quantity }}" >
                                    </label>
                                </div>
                                @empty
                                    <p>Color not found</p>
                                @endforelse
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Add Color</label>
                            <div class="row">
                                @forelse ( $colors as $color )
                                <div class="col-sm-3 border h-100 text-white" style="background-color: {{ $color->code }}">
                                    <div class="mt-2 custom-control custom-checkbox checkbox-secondary d-inline-block mr-3">
                                        <input type="checkbox"  value="{{ $color->id }}" name="colors[{{ $color->id }}]" class="custom-control-input" id="label-{{$color->id}}">
                                        <label class="custom-control-label" for="label-{{$color->id}}">{{ $color->name }}</label>
                                    </div>
                                    <label class="mt-1 p-2">
                                        Quantity
                                        <input type="number" class="form-control" name="color_quantity[{{  $color->id }}]" value="{{ old( 'color_quantity.' . $color->id ) }}" >
                                    </label>
                                </div>
                                @empty
                                    <p>Color not found</p>
                                @endforelse
                            </div>
                        </div>
                        @if ( $colors_product )
                            <div class="mb-3">
                                <label for="" class="form-label">Màu của riêng sản phẩm</label>
                                <div class="row">
                                    @forelse ( $colors_product as $color_product )
                                    <div class="col-sm-3 border h-100" style="background-color: {{ $color_product->code }}">
                                        <div class="mt-2 custom-control custom-checkbox checkbox-secondary d-inline-block mr-3 mb-3">
                                            <input type="checkbox" value="{{ $color_product->id }}" name="colors[{{ $color_product->id }}]" @if ( old( 'colors.' . $color_product->id ) == "on" ) checked @endif class="custom-control-input" id="only-label-{{$color_product->id}}">
                                            <label class="custom-control-label" for="only-label-{{$color_product->id}}">{{ $color_product->name }}</label>
                                        </div>
                                        <label class="">
                                            Quantity
                                            <input type="number" class="form-control" name="color_quantity[{{  $color_product->id }}]" value="{{ old( 'color_quantity.' . $color_product->id ) }}">
                                        </label>
                                    </div>
                                    @empty
                                        <p class="mx-2">Color not found</p>
                                    @endforelse
                                </div>
                            </div>
                        @endif

                        <div class="mb-3">
                            <label for="" class="form-label">New Color</label>
                            <div class="row">
                                <div class="table-responsive">
                                    <table class="table table-primary">
                                        <thead>
                                            <tr>
                                                <th scope="col">Name</th>
                                                <th scope="col">Code</th>
                                                <th scope="col">Quantity</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="">
                                                <td scope="row"><input type="text" class="form-control" id="colorName"></td>
                                                <td><input type="text" class="form-control" id="colorCode"></td>
                                                <td><input type="number" class="form-control" id="colorQuantity"></td>
                                                <td><button type="button" class="btn btn-primary bg-primary text-white" id="newColor">Add</button></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div  class="text-end mt-3">
                    <button type="submit" class="btn btn-success bg-success text-white">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        var i = 1;
        $( "#newColor" ).click(function (e) {
            e.preventDefault();
            var name = $( "#colorName" ).val();
            var code = $( "#colorCode" ).val();
            var quantity = $( "#colorQuantity" ).val();
            if ( name && code && quantity ) {
                $( "#colors" ).append(render( name, code, quantity, i ));
                reset();
            }
        });

        function reset() {
            $( "#colorName" ).val( "" );
            $( "#colorCode" ).val( "" );
            $( "#colorQuantity" ).val( "" );
        }

        function render( name, code, quantity, i ) {
            i++;
            return  '<div class="col-sm-3 border h-100 text-white" style="background-color: ' + code + '  "> ' +
                        '<div class="mt-2 custom-control custom-checkbox checkbox-secondary d-inline-block mr-3">' +
                            '<input type="checkbox" name="newColors[]" value="' + name + '" checked class="custom-control-input" id="new-label-'+ i +'">' +
                            '<label class="custom-control-label" for="new-label-'+ i +'">' + name + '</label>' +
                        '</div>' +
                        '<input type="hidden" name="newCode[]" value="'+ code +'">' +
                        '<label class="mt-1 p-2">' +
                            'Quantity' +
                            '<input type="number" class="form-control" name="newQuantity[]" value="'+ quantity +'" >' +
                        '</label>' +
                    '</div>';
        }
    </script>
@endsection
