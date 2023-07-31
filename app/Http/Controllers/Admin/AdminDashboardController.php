<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller {

  public function index() {

    $all = User::all();
    $admins = User::where('role', 'admin')->get();
    $normalUser = User::where('role', 'user')->get();
    $category = Category::all();
    $categoryWithPost = Category::has('posts');
    $post = Post::with('user')->with('category')->get();

    return view('admin.dashboard', compact('all', 'admins', 'normalUser', 'category', 'categoryWithPost', 'post'));
  }
}
