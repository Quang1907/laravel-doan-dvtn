<?php
namespace App\Services;

use App\Models\Category;
use App\Models\CategoryPosts;
use App\Repositories\CategoryPostReponsitory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryPostService {
    protected $categoryReponsitory = null;

    public function __construct( CategoryPostReponsitory $categoryReponsitory ) {
        $this->categoryReponsitory = $categoryReponsitory;
    }

    public function allCategory() {
        return $this->categoryReponsitory->allCategory();
    }

    public function categoryWithPost() {
        return $this->categoryReponsitory->categoryWithPost();
    }

    public function searchCategory( Request $request ) {
        return $request->search  ? $this->categoryReponsitory->searchCategory( $request->search ) : false;
    }

    public function findCategoryPost( $id ) {
        return $this->categoryReponsitory->find( $id );
    }

    public function categoryPost( $slug ) {
        $category = $this->categoryReponsitory->whereSlug( $slug );
        return $this->categoryReponsitory->whereCate( $category->id );
    }

    public function whereSlug( $slug ) {
        return $this->categoryReponsitory->whereSlug( $slug );
    }

    public function paginationCategory( ) {
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
