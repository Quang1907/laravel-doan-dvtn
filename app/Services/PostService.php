<?php
namespace App\Services;

use App\Imports\PostImport;
use App\Models\Post;
use App\Repositories\PostReponsitory;
use Illuminate\Bus\Batchable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class PostService {
    use Batchable;

    private $postReponsitory = null;

    public function __construct( PostReponsitory $postReponsitory )
    {
        $this->postReponsitory = $postReponsitory;
    }

    public function allPost() {
        return $this->postReponsitory->all();
    }

    public function paginationPost( ) {
        $number = 5;
        return $this->postReponsitory->pagination( $number );
    }

    public function createPost( Request $request ) {
        $data = $this->postReponsitory->create( $request->all() );
        Alert::toast('Post Created Successfully.', 'success');
        return $data->categories()->attach( $request->category_id );
    }

    public function updatePost( Request $request, Post $post ) {
        $this->postReponsitory->update( $request->all(), $post );
        Alert::toast('Post Updated Successfully.', 'success');
        return $post->categories()->sync( $request->category_id );
    }

    public function deletePost( Post $post ) {
        $post->delete();
        return Alert::toast('Post deleted successfully.', 'success');
    }

    public function uploadFile( Request $request ) {
        $file = $request->file( "upload_file" )->store( "import" );
        $import = new PostImport;
        $import->queue( $file );
        // $batch = Bus::batch( [
        //     Excel::queueImport(new PostImport, $file)
        // ] )->dispatch();
    }
}
