@extends( 'layouts.admin_master' )
@section('title', 'Edit Product')
@section('content')
    <div class="card">
        <div class="card-header rounded d-flex">
            <div class="w-100">
                <h2 class="h2">Edit Product</h2>
            </div>
            <div class="w-100 text-right">
                <a href="{{ route('product.index') }}" class="btn text-white btn-warning btn-sm">Back</a>
            </div>
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
                            <select class="form-control" name="category_id" id="select_category">
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
                            <label for="" class="form-label">Select Brand</label>
                            <select class="form-control" name="brand" id="select_brands">
                                <option selected>Choose an brand</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="small_description" class="form-label">Small Description( 500 words )</label>
                            <textarea class="form-control" name="small_description" id="small_description" rows="4">{{ old( 'small_description', $product->small_description ) }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Description</label>
                            <textarea id="my-editor" name="description" class="form-control">{!! old( 'description', $product->description ) !!}</textarea>
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
                                class="form-control" name="original_price"  value="{{ old( 'original_price', $product->original_price ) }}"  id="original_price">
                            </div>
                            <div class="mb-3 col-sm-4">
                                <label for="selling_price" class="form-label">Selling Price</label>
                                <input type="number" class="form-control"  value="{{ old( 'selling_price', $product->selling_price ) }}" name="selling_price" id="selling_price">
                            </div>
                            <div class="mb-3 col-sm-4">
                                <label for="quantity" class="form-label">Quantity</label>
                                <input type="number" class="form-control"  value="{{ old( 'quantity', $product->quantity ) }}" name="quantity" id="quantity">
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
                        <div>
                            <h3 class="w-100">Hình ảnh mô tả</h3>
                            <div class="input-group">
                                <span class="input-group-btn">
                                <a id="lfm1" data-input="thumbnail1" data-preview="holder1" class="btn btn-sm btn-primary text-white">
                                    <i class="fa fa-picture-o"></i> Choose
                                </a>
                                </span>
                                <input id="thumbnail1" class="form-control"  value="{{ old( 'image', $product->image ) }}" type="hidden" name="image">
                            </div>
                            <div id="holder1" class="row mb-2" style="margin-left:10px; margin-top:15px;max-height:100px;">
                                <div class="col-sm-2">
                                    <img src="{{ old( 'image', $product->image ) }}" class="w-100 rounded-lg" alt="">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div>
                            <h3 class="w-100">Hình ảnh chi tiết</h3>
                            <div class="input-group">
                                <span class="input-group-btn">
                                <a id="lfm2" data-input="thumbnail2" data-preview="holder2" class="btn btn-sm btn-primary text-white">
                                    <i class="fa fa-picture-o"></i> Choose
                                </a>
                                </span>
                                <input id="thumbnail2" class="form-control"  value="{{ old( 'images' ) }}" type="hidden" name="images">
                            </div>
                            <div id="holder2" class="flex mb-2" style="margin-top:15px;max-height:100px;">
                            </div>
                            <div class="row p-2">
                                @foreach ( $product->productImages()->get() as $imageDetail )
                                    <div class="col-sm-2 text-center">
                                        <img src="{{ asset( $imageDetail->image ) }}" class="w-100 rounded-lg" alt="">
                                        <a href="{{ route( 'product-image.delete', $imageDetail ) }}"><i class="fa-solid fa-xmark"></i></a>
                                    </div>
                                @endforeach
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
                                    <p id="noColor">Color not found</p>
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
                                                <td><input type="number" value="0" class="form-control" id="colorQuantity"></td>
                                                <td><button type="button" class="btn btn-sm btn-primary bg-primary text-white" id="newColor">Add</button></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div  class="text-end mt-3">
                    <button type="submit" class="btn btn-sm btn-success bg-success text-white">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script>
        $('#lfm1').filemanager('image');
        $('#lfm2').filemanager('images');

        var i = 1;
        $( "#newColor" ).click(function (e) {
            e.preventDefault();
            var name = $( "#colorName" ).val();
            var code = $( "#colorCode" ).val();
            var quantity = $( "#colorQuantity" ).val();
            if ( name && code && quantity ) {
                reset();
                $( "#colors" ).append(render( name, code, quantity, i ));
            }
        });

        function reset() {
            $( "#colorName" ).val( "" );
            $( "#colorCode" ).val( "" );
            $( "#colorQuantity" ).val( "" );
            $( "#noColor" ).hide();
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


        var options = {
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
        };

        CKEDITOR.replace('my-editor', options);

        var old_select_category = $( "#select_category" ).find( ":selected").val();

        if ( old_select_category != 0 ) {
            find_brand_with_category( old_select_category );
        }

        $( "#select_category" ).change( function ( e ) {
            e.preventDefault();
            var category_id = $(this).find( ":selected" ).val();
            find_brand_with_category( category_id );
        } )

        function find_brand_with_category( category_id ) {
            $.ajax({
                type: "get",
                url: "{{ url( 'admin/category-products/brands/'  ) }}/" + category_id,
                success: function ( response ) {
                    var options = "<option selected>Choose an brand</option>";
                    if ( (response.brands).length > 0 ) {
                        options = "";
                        var selected = "";
                        var id_old = {{ old( 'brand') }}

                        $.each( response.brands , function ( indexInArray, valueOfElement ) {
                            if ( id_old == valueOfElement.id ) {
                                selected = "selected";
                            }
                            options += "<option " +  selected + " value=" + valueOfElement.id + ">" + valueOfElement.name + "</option>";
                        });
                    }

                    $( "#select_brands" ).html( options );
                }
            });
        }
    </script>

@endsection

