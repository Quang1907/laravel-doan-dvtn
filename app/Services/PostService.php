<?php
namespace App\Services;

use App\Imports\PostImport;
use App\Models\Post;
use App\Repositories\PostReponsitory;
use Illuminate\Bus\Batchable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use Exception;

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

    public function trending() {
        return $this->postReponsitory->trending();
    }

    public function slugPost( $slug ) {
        return $this->postReponsitory->where( "slug", $slug );
    }

    public function searchPost( $title ) {
        return $this->postReponsitory->whereTitle( "title", $title );
    }

    public function paginationPost( ) {
        $pagination = config( "pagination.post");
        return $this->postReponsitory->pagination( $pagination );
    }

    public function createPost( Request $request ) {
        DB::beginTransaction();

        try {
            $data = $request->all();
            $data['slug'] = Str::slug( $data["title"] );
            $data['user_id'] = auth()->user()->id;
            $data['trending_post'] = !empty( $data[ 'trending_post' ] ) ? true : false;

            $image = $request->file("image");

            if ( $request->googleDrive ) {
                $imageId = $image->store( "", "google");
                $data['image'] = \Storage::disk('google')->url($imageId);
            }else{
                $fileName = time() . $image->getClientOriginalName();
                $image->storeAs( "public", $fileName);
                $data['image'] = $fileName;
            }

            $data = $this->postReponsitory->create( $data );

            $data->categories()->attach( $request->category_id );

            Alert::toast( 'Post Created Successfully.', 'success' );
        } catch ( Exception $e ) {
            DB::rollBack();

            throw new Exception( $e->getMessage() );
        }

        DB::commit();
    }

    public function updatePost( Request $request, Post $post ) {
        $data = $request->all();
        $data['slug'] = Str::slug( $data["title"] );
        $data['user_id'] = auth()->user()->id;
        $data['trending_post'] = !empty( $data[ 'trending_post' ] ) ? true : false;
        $image = $request->file("image");

        if ( !empty( $image ) ) {
            if ( $request->googleDrive ) {
                $imageId = $image->store( "", "google");
                $data['image'] = \Storage::disk('google')->url($imageId);
            }else{
                $fileName = time() . $image->getClientOriginalName();
                $image->storeAs( "public", $fileName);
                $data['image'] = $fileName;
            }
        }

        $this->postReponsitory->update( $data, $post );
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
    }

    public function recentPost( $limit = 3 ) {
        return $this->postReponsitory->orderByAndLimit( "DESC", $limit );
    }
}
