<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductFormRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy( "id", "DESC" )->with( "category" )->paginate( 5 );
        return view( "admin.product.index", compact( "products") );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        $colors = Color::where( "product_id", "=", 0 )->get();
        return view( "admin.product.create", compact( "categories", "brands", "colors" ) );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( ProductFormRequest $request )
    {
        $category = Category::findOrFail( $request->category_id );
        $request[ 'slug' ] = Str::slug( $request->slug );
        $request[ 'trending' ] =  $this->checkBox($request[ 'trending' ]) ;
        $request[ 'status' ] =  $this->checkBox($request[ 'status' ]) ;


        $product =  $category->products()->create( $request->all() );
        if ( $request->hasFile( "imageFile" ) ) {
            $uploadPath = "uploads/products/";

            $files = $request->file( "imageFile" );
            $i = 1;
            foreach ( $files as $imageFile ) {
                $ext =  $imageFile->getClientOriginalExtension();
                $fileName =  time() . $i++ . "-" . $ext;
                $imageFile->move( $uploadPath, $fileName );
                $finalImagePathName = $uploadPath . $fileName;
                $product->productImages()->create( [ "product_id" => $product->id, 'image' =>  $finalImagePathName ] );
            }
        }


        if ( $request->colors ) {
            $colors = $request->colors;
            foreach ( $colors as $key => $color ) {
                $product->productColors()->attach(  $color , [ "quantity" =>  $request->color_quantity[ $key ] ?? 0 ] );
            }
        }

        return redirect()->route( "product.index" )->with( "message", "Product Created Successfully.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( $id )
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( $id )
    {
        $product = Product::findOrFail( $id );
        $categories = Category::all();
        $brands = Brand::all();
        $colorsArr = array();

        $product_colors  = $product->productColors->each( function ( $product_colors  ) use (&$colorsArr) {
            $colorsArr[$product_colors->id] = $product_colors->id;
        });

        $colors =  Color::whereNotIn( "id", $colorsArr )->where( "product_id", "<>", $id )->get();
        $colors_product = Color::whereNotIn( "id", $colorsArr )->where( "product_id", "=", $id )->get();

        return view( "admin.product.edit", compact( "product", "categories", "brands", "colors", "product_colors", "colors_product" ) );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update( ProductFormRequest $request, $id )
    {
        $product = Product::findOrFail( $id );
        $request[ 'slug' ] = Str::slug( $request->slug );
        $request[ 'trending' ] =  $this->checkBox($request[ 'trending' ]) ;
        $request[ 'status' ] =  $this->checkBox($request[ 'status' ]) ;

        $product->update( $request->all() );
        if ( $request->hasFile( "imageFile" ) ) {
            $uploadPath = "uploads/products/";
            $files = $request->file( "imageFile" );
            $i = 1;
            foreach ( $files as $imageFile ) {
                $ext =  $imageFile->getClientOriginalExtension();
                $fileName =  time() . $i++ . "-" . $ext;
                $imageFile->move( $uploadPath, $fileName );
                $finalImagePathName = $uploadPath . $fileName;
                $product->productImages()->create( [ "product_id" => $product->id, 'image' =>  $finalImagePathName ] );
            }
        }

        $product->productColorTable()->delete();

        if ( !empty( $request->newColors ) ) {
            $arrColors = array();

            foreach (  $request->newColors as $key => $color ) {
                $colorId = Color::create( [
                    "name" => $request->newColors[$key],
                    "code" => $request->newCode[$key],
                    "product_id" => $id,
                ]);
                $arrColors[$key] = $colorId->id;
            }
            foreach ( $arrColors as $keyArr => $arrColor ) {
                $product->productColors()->attach(  $arrColor , [ "quantity" => $request->newQuantity[$keyArr] ?? 0 ] );
            }

        }

        if ( $request->colors ) {
            foreach ( $request->colors as $key => $color ) {
                $product->productColors()->attach(  $color , [ "quantity" => $request->color_quantity[$key] ?? 0 ] );
            }
        }

        return redirect()->route( "product.index" )->with( "message", "Product Updated Sucessfully" );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail( $id );
        if ( $product->productImages ) {
            foreach ( $product->productImages as $imagePath ) {
                if ( File::exists( $imagePath->image ) ) {
                    File::delete( $imagePath->image );
                }
            }
        }
        $product->delete();
        return redirect()->back()->with( "message", "Product deleted successfully" );
    }

    public function deleteImage( int $product_image_id ) {
        $productImage = ProductImage::findOrFail( $product_image_id );
        if ( File::exists( $productImage->image ) ) {
            File::delete( $productImage->image );
        }
        $productImage->delete();
        return redirect()->back()->with( "message", "Product Image Deleted" );
    }

    public function checkBox( $data ) {
        return $data == "on" ? true : false;
    }
}
