<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class UserCategoryController extends Controller {
  public function index() {
    $posts = Post::latest()->paginate(10);
    $categories = Category::has('posts')->get();
    return view('user.category', compact('posts', 'categories'));
  }

  public function show($id) {
    $categories = Category::has('posts')->get();
    $category = Category::find($id);
    $categoryName = $category->name;
    $posts = $category->posts()->paginate(10);
    return view('user.category-show', compact('posts', 'categories', 'categoryName'));
  }
}
