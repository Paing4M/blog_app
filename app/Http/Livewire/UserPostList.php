<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class UserPostList extends Component {
  use WithFileUploads, WithPagination;
  protected $paginationTheme = 'bootstrap';

  public $image, $title, $category, $content, $edit_id, $tempImg, $tags;

  public $search, $postBy, $categoryBy;

  public $delete_id;

  protected $listeners = ['resetModalForm'];

  public function mount() {
    $this->resetPage();
  }

  public function updatingSearch() {
    $this->resetPage();
  }

  public function updatingCategoryBy() {
    $this->resetPage();
  }

  public function updatingPostBy() {
    $this->resetPage();
  }


  public function addPost() {
    $this->validate([
      'title' => 'required',
      'image' => 'required|image|mimes:jpeg,png,gif,jpg',
      'category' => 'required',
      'tags' => 'required',
      'content' => 'required'
    ]);

    $fileName = time() .  Str::random(5) . $this->image->getClientOriginalName();

    $post = new Post();
    $post->title = $this->title;
    $post->user_id = Auth()->user()->id;
    $post->category_id = $this->category;
    $post->content = $this->content;
    $post->image = $fileName;
    $this->image->storeAs('public/images', $fileName);
    $saved = $post->save();
    if ($saved) {
      $this->dispatchBrowserEvent('closeModal');
      session()->flash('message', 'Post successfully added.');
    }
  }

  public function editPost($id) {
    $this->edit_id = $id;
    $post = Post::find($this->edit_id);
    if ($this->edit_id) {
      $this->image = '';
      $this->category = $post->category_id;
      $this->title = $post->title;
      $this->content = $post->content;
      $this->tempImg = $post->image;
      $this->dispatchBrowserEvent('openModal');
    }
  }

  public function updatePost() {
    $this->validate([
      'title' => 'required',
      'category' => 'required',
      'tags' => 'required',
      'content' => 'required',
    ]);

    $post = Post::find($this->edit_id);
    $fileName = '';

    if ($this->image) {
      File::delete('storage/images/' . $post->image);

      $fileName = time() .  Str::random(5) . $this->image->getClientOriginalName();
      $this->image->storeAs('public/images', $fileName);
    } else {
      $fileName = $this->tempImg;
    }

    $updated =  $post->update([
      'title' => $this->title,
      'user_id' => Auth::user()->id,
      'category_id' => $this->category,
      'content' => $this->content,
      'image' => $fileName,
    ]);

    if ($updated) {
      $this->dispatchBrowserEvent('closeModal');
      session()->flash('message', 'Post successfully updated.');
    }
  }

  public function deletePost($id) {
    $this->delete_id = $id;
    if ($this->delete_id)
      $this->dispatchBrowserEvent('openDeleteModal');
  }

  public function deleteConfirm() {
    if ($this->delete_id) {
      $post = Post::find($this->delete_id);
      $imagePath = 'storage/images/' . $post->image;
      if (File::exists($imagePath)) {
        File::delete($imagePath);
      }
      $deleted = $post->delete();
      if ($deleted) {
        $this->dispatchBrowserEvent('closeModal');
        $this->delete_id = '';
        session()->flash('message', 'Post successfully deleted.');
      }
    }
  }


  public function resetModalForm() {
    $this->resetErrorBag();
    $this->edit_id = '';
    $this->image = '';
    $this->title = '';
    $this->category = '';
    $this->content = '';
    $this->tempImg = '';
  }


  public function render() {
    $categories = Category::all();
    $users = User::has('posts')->get();

    if (auth()->user()->role === 'admin') {

      $posts = Post::search(trim($this->search))->when($this->postBy, function ($query) {
        $query->where('user_id', $this->postBy);
      })->when($this->categoryBy, function ($query) {
        $query->where('category_id', $this->categoryBy);
      })->latest()->paginate(8);
    } else {
      $posts = Post::search(trim($this->search))->where('user_id', auth()->user()->id)->when($this->categoryBy, function ($query) {
        $query->where('category_id', $this->categoryBy);
      })->latest()->paginate(8);
    }



    return view('livewire.user-post-list', compact(['categories', 'posts', 'users']));
  }
}
