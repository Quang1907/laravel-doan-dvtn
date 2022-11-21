<?php
namespace App\Services;

use App\Models\Brand;
use App\Models\CategoryProduct;
use App\Models\Color;
use App\Models\ProductImage;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProductService {

    private $productRepository = null;

    public function __construct( ProductRepository $productRepository ) {
        $this->productRepository = $productRepository;
    }

    public function allProduct() {
        return $this->productRepository->all();
    }

    public function whereSlug( $slug ) {
        return $this->productRepository->slug( $slug );
    }

    public function create() {
        $categories = CategoryProduct::where("status", true)->get();
        $brands = Brand::where("status", true)->get();
        $colors = Color::where( "status", true)->where( "product_id", "=", 0 )->get();
        return view( "admin.product.create", compact( "categories", "brands", "colors" ) );
    }

    public function storeProduct( Request $request ) {
        $category = CategoryProduct::findOrFail( $request->category_id );
        $request[ 'slug' ] = Str::slug( $request->name );
        $request[ 'trending' ] =  $this->checkBox($request[ 'trending' ]) ;
        $request[ 'status' ] =  $this->checkBox($request[ 'status' ]) ;
        $product =  $category->products()->create( $request->all() );
        $image = str_replace( $request->root(), "", $request->image );
        $imageArr = explode( ",", $image );

        foreach ( $imageArr as $key => $image) {
            $product->productImages()->create( [ "product_id" => $product->id, 'image' =>  $image ] );
        }

        if ( $request->colors ) {
            $colors = $request->colors;
            foreach ( $colors as $key => $color ) {
                $product->productColors()->attach(  $color , [ "quantity" =>  $request->color_quantity[ $key ] ?? 0 ] );
            }
        }
    }

    public function editProduct( $id ) {
        $product = $this->productRepository->findOrFail( $id );
        $categories = CategoryProduct::where("status", true)->get();
        $brands = Brand::where( "status", true)->get();

        $colorsArr = array();
        $product_colors  = $product->productColors->each( function ( $product_colors  ) use (&$colorsArr) {
            $colorsArr[$product_colors->id] = $product_colors->id;
        });

        $colors =  Color::where( "status", true)->where( "product_id", "=", 0 )->whereNotIn( "id", $colorsArr )->get();
        $colors_product = Color::where( "status", true)->where( "product_id", "=", $id )->whereNotIn( "id", $colorsArr )->get();

        return view( "admin.product.edit", compact( "product", "categories", "brands", "colors", "product_colors", "colors_product" ) );
    }

    public function updateProduct( Request $request, $id ) {
        $product =  $this->productRepository->findOrFail( $id );
        $request[ 'slug' ] = Str::slug( $request->name );
        $request[ 'trending' ] =  $this->checkBox($request[ 'trending' ]) ;
        $request[ 'status' ] =  $this->checkBox($request[ 'status' ]) ;

        $product->update( $request->all() );
        $image = str_replace( $request->root(), "", $request->image );
        $imageArr = explode( ",", $image );
        foreach ( $imageArr as $key => $image) {
            $product->productImages()->create( [ "product_id" => $product->id, 'image' =>  $image ] );
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
    }

    public function deleteProduct( $id ) {
        $product = $this->productRepository->findOrFail( $id );
        if ( $product->productImages ) {
            foreach ( $product->productImages as $imagePath ) {
                if ( File::exists( $imagePath->image ) ) {
                    File::delete( $imagePath->image );
                }
            }
        }
        $product->delete();
    }

    public function deleteImage( int $product_image_id ) {
        $productImage = ProductImage::findOrFail( $product_image_id );

        if ( File::exists( $productImage->image ) ) {
            File::delete( $productImage->image );
        }

        $productImage->delete();
    }

    public function checkBox( $data ) {
        return $data == "on" ? true : false;
    }

    public function trendingProducts() {
        return $this->productRepository->trending();
    }
}
