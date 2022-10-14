<?php
namespace App\Services;

use App\Repositories\CategoryReponsitory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
        $request['slug'] = Str::slug( $request->name );
        return $this->categoryReponsitory->create( $request->all() );
    }

    public function update( Request $request,  $category  ) {
        return $this->categoryReponsitory->update( $request->all(), $category );
    }
}
