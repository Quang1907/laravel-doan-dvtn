<?php

namespace App\Http\Livewire\Client\Post;

use App\Models\PostComment;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PostShow extends Component
{
    public $post;
    public $all_comments_count;
    public $comments;

    public $reply = "", $name_user = "";

    public $comment;

    protected $rules = [
        "comment" => "required",
    ];

    public function comment() {
        $this->validate();
        if ( Auth::check() ) {
            $user = auth()->user()->id;
            $parent_id = $this->reply['id'] ?? null;
            PostComment::create([
                "user_id" => $user,
                "post_id" => $this->post->id,
                "content" => $this->comment,
                "parent_id" => $parent_id,
            ]);
            $this->dispatchBrowserEvent( 'message' ,[
                'text' => "Comment successfully",
                'type' => "success",
                'status' => "202",
            ]);
        } else {
            $this->dispatchBrowserEvent( 'message' ,[
                'text' => "vui lòng đăng nhập",
                'type' => "warning",
                'status' => "404",
            ]);
        }
        $this->reset( [ "comment", "name_user", "reply" ] );
        $this->mount( $this->post );
    }

    public function reply( $id ) {
        $this->reply = $this->post->comments->find( $id );
        $this->name_user = $this->reply->user()->first()->name;
    }

    public function mount( $post ) {
        $this->post = $post;
        $this->all_comments_count = $this->post->comments()->count() ;
        $this->comments = $this->post->comments()->orderBy( "id", "DESC" )->get();
        $this->replyingto = [];
    }
    public function render()
    {
        return view('livewire.client.post.post-show');
    }
}
