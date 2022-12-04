@extends( 'layouts.admin_master' )

@section('title', 'Create Product')
@section('content')
    <div class="card">
        <div class="card-header rounded d-flex">
            <div class="w-100">
                <h2 class="h2">Create Product</h2>
            </div>
            <div class="w-100 text-right">
                <a href="{{ route('product.index') }}" class="btn text-white btn-warning btn-sm">Back</a>
            </div>
        </div>
        <div class="card-body">
            <x-errors.any />
            <form action="{{ route( 'product.store') }}" method="post" enctype="multipart/form-data">
                @csrf
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
                                <option selected value="0">Choose an category</option>
                                @forelse ( $categories as $category )
                                    <option value="{{ $category->id }}" @if ( old( 'category_id', "" ) == $category->id ) selected @endif >{{ $category->name }}</option>
                                @empty
                                    <option >Category not found</option>
                                @endforelse
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Product Name</label>
                            <input type="text"
                            class="form-control" name="name" value="{{ old( 'name' ) }}" id="name">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Select Brand</label>
                            <select class="form-control" name="brand" id="select_brands">
                                <option selected>Choose an brand</option>
                                {{-- @forelse ( $brands as $brand )
                                    <option value="{{ $brand->id }}" @if ( old( 'brand', '' ) == $brand->id ) selected @endif >{{ $brand->name }}</option>
                                @empty
                                    <option >Brand not found</option>
                                @endforelse --}}
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="small_description" class="form-label">Small Description( 500 words )</label>
                            <textarea class="form-control" name="small_description" id="small_description" rows="4">{{ old( 'small_description' ) }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Description</label>
                            <textarea id="my-editor" name="description" class="form-control">{!! old('description') !!}</textarea>
                        </div>
                    </div>
                    <div class="tab-pane fade border p-3" id="seo-tag" role="tabpanel" aria-labelledby="seo-tag-tab">
                        <div class="mb-3">
                        <label for="meta_title" class="form-label">Meta Title</label>
                        <input type="text" class="form-control" name="meta_title" id="meta_title" value="{{ old( 'meta_title' ) }}" >
                        </div>
                        <div class="mb-3">
                            <label for="meta_description" class="form-label">Meta Keyword</label>
                            <textarea class="form-control" name="meta_description" id="meta_description" rows="4">{{ old( 'meta_description' ) }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="meta_keyword" class="form-label">Meta Description</label>
                            <textarea class="form-control" name="meta_keyword" id="meta_keyword" rows="4">{{ old( 'meta_keyword' ) }}</textarea>
                        </div>
                    </div>
                    <div class="tab-pane fade border p-3" id="detail" role="tabpanel" aria-labelledby="detail-tab">
                        <div class="row">
                            <div class="mb-3 col-sm-4">
                                <label for="original_price" class="form-label">Original Price</label>
                                <input type="number"
                                class="form-control" name="original_price" value="{{ old( 'original_price', 0 ) }}"  id="original_price">
                            </div>
                            <div class="mb-3 col-sm-4">
                                <label for="selling_price" class="form-label">Selling Price</label>
                                <input type="number" class="form-control" value="{{ old( 'selling_price', 0 ) }}" name="selling_price" id="selling_price">
                            </div>
                            <div class="mb-3 col-sm-4">
                                <label for="quantity" class="form-label">Quantity</label>
                                <input type="number" class="form-control" value="{{ old( 'quantity', 0 ) }}" name="quantity" id="quantity">
                            </div>
                            <div class="mb-3 mx-3 d-flex">
                                <div class="custom-control custom-checkbox checkbox-success d-inline-block mr-3 mb-3">
                                    <input type="checkbox" class="custom-control-input" id="trending" @if ( old( 'trending' ) == "on" ) checked @endif name="trending">
                                    <label class="custom-control-label" for="trending">Treding</label>
                                </div>
                                <div class="custom-control custom-checkbox checkbox-success d-inline-block mr-3 mb-3">
                                    <input type="checkbox" class="custom-control-input" id="status" @if ( old( 'status' ) == "on" ) checked @endif name="status">
                                    <label class="custom-control-label" for="status">Status</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade border p-3" id="product-image" role="tabpanel" aria-labelledby="product-image-tab">
                        <div>
                            <label for="meta_title" class="form-label">Images Description</label>
                                <div class="input-group">
                                    <span class="input-group-btn">
                                    <a id="lfm1" data-input="thumbnail1" data-preview="holder1" class="btn btn-sm btn-primary text-white">
                                        <i class="fa fa-picture-o"></i> Choose
                                    </a>
                                    </span>
                                    <input id="thumbnail1" class="form-control" type="hidden" value="{{ old( 'image' ) }}" name="image" >
                                </div>
                                <div id="holder1" class="flex" style="margin-top:15px;max-height:100px;">
                                    @if ( !empty( old( 'image' ) ) )
                                        <img src="{{ asset( old( 'image' ) ) }}" width="80px" alt="">
                                    @endif
                            </div>
                        </div>
                        <div>
                            <label for="meta_title" class="form-label">Images Detail</label>
                                <div class="input-group">
                                    <span class="input-group-btn">
                                    <a id="lfm2" data-input="thumbnail2" data-preview="holder2" class="btn btn-sm btn-primary text-white">
                                        <i class="fa fa-picture-o"></i> Choose
                                    </a>
                                    </span>
                                    <input id="thumbnail2" class="form-control" type="hidden" value="{{ old( 'images' ) }}" name="images" >
                                </div>
                                <div id="holder2" class="flex" style="margin-top:15px;max-height:100px;">
                                    @if ( !empty( old( 'images' ) ) )
                                        @php ( $olds = explode( ",", old( 'images' ) ))
                                        @foreach ( $olds as $old )
                                            <img src="{{ asset( $old ) }}" width="80px" alt="">
                                        @endforeach
                                    @endif
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade border p-3" id="product-color" role="tabpanel" aria-labelledby="product-color-tab">
                        <div class="mb-3">
                            <label for="" class="form-label">Select color</label>
                            <div class="row">
                                @forelse ( $colors as $color )
                                <div class="col-sm-3 border h-100" style="background-color: {{ $color->code }}">
                                    <div class="mt-2 custom-control custom-checkbox checkbox-secondary d-inline-block mr-3 mb-3">
                                        <input type="checkbox" value="{{ $color->id }}" name="colors[{{ $color->id }}]" @if ( old( 'colors.' . $color->id ) == $color->id ) checked @endif class="custom-control-input" id="label-{{$color->id}}">
                                        <label class="custom-control-label" for="label-{{$color->id}}">{{ $color->name }}</label>
                                    </div>
                                    <label class="">
                                        Quantity
                                        <input type="number" class="form-control" name="color_quantity[{{  $color->id }}]" value="{{ old( 'color_quantity.' . $color->id ) }}">
                                    </label>
                                </div>
                                @empty
                                    <p class="mx-2">Color not found</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-end mt-3">
                    <button type="submit" class="btn btn-sm btn-success bg-success text-white">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section( 'script' )
    <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script>
        $('#lfm1').filemanager('image');
        $('#lfm2').filemanager('images');

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
