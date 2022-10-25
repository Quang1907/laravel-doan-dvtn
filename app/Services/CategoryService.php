<?php
namespace App\Services;

use App\Models\Category;
use App\Repositories\CategoryReponsitory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryService {
    protected $categoryReponsitory = null;

    public function __construct( CategoryReponsitory $categoryReponsitory ) {
        $this->categoryReponsitory = $categoryReponsitory;
    }

    public function allCategory() {
        return $this->categoryReponsitory->all();
    }

    public function categortPost() {
        $category = $this->categoryReponsitory->whereName("Hoạt động");
        return $this->categoryReponsitory->whereCate( $category->id );
    }

    public function paginationCategory() {
        $pagination = config( "pagination.category" );
        return $this->categoryReponsitory->pagination( $pagination );
    }

    public function create( Request $request ) {
        $request[ 'image' ] = str_replace( $request->root(), "", $request->image );
        $request["status"] = ( $request->status == "on" ) ? 1 : 0 ;
        $request['slug'] = Str::slug( $request->name );
        return $this->categoryReponsitory->create( $request->all() );
    }

    public function update( Request $request,  $category  ) {
        $request[ 'image' ] = str_replace( $request->root(), "", $request->image );
        $request[ "status" ] = ( $request->status == "on" ) ? 1 : 0 ;
        $request[ "slug" ] =  Str::slug( $request->slug );

        return $this->categoryReponsitory->update( $request->all(), $category );
    }

    public function delete( Category $category ) {
        $category->delete();
        return Alert::toast( 'Post Deleted Successfully.', 'success' );
    }
}
