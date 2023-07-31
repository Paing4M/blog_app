<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Livewire\Component;

class Comments extends Component {

  public $comment, $post_id;


  public function addComment() {
    $comment = new Comment();
    $comment->comment = $this->comment;
    $comment->post_id = $this->post_id;
    $comment->user_id = Auth()->user()->id;
    $comment->save();
    $this->comment = '';
  }

  public function render() {
    $comments = Comment::where('post_id', $this->post_id)->get();
    return view('livewire.comments', compact('comments'));
  }
}
