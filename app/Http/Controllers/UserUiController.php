<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Skill;
use Illuminate\Http\Request;

class UserUiController extends Controller {
  public function index() {
    $posts = Post::latest()->paginate(4);
    return view('user.blogs', compact('posts'));
  }
}
