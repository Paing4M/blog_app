<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserPostController extends Controller {
  public function index() {
    return view('user.posts');
  }

  public function detail($id) {
    $post = Post::findOrFail($id);
    $comments = Comment::where('post_id', $post->id)->get();
    return view('user.post-detail', compact('post', 'comments'));
  }



  public function search(Request $request) {
    $search = $request->query('search');

    $categories = Category::has('posts')->get();

    $posts = Post::with('category')->with('user')->where('title', 'LIKE', '%' . $search . '%')->paginate(10);
    return view('user.search', compact('categories', 'posts', 'search'));
  }
}
