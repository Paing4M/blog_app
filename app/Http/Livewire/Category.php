<?php

namespace App\Http\Livewire;

use App\Models\Category as ModelsCategory;
use Livewire\Component;
use Livewire\WithPagination;

class Category extends Component {

  use WithPagination;

  public $name;
  public $edit_id = null;
  public $delete_id = null;

  protected $listeners = ['resetModalForm'];

  public function mount() {
    $this->resetPage();
  }

  public function addCategory() {
    $this->validate([
      'name' => 'required|unique:categories,name'
    ]);

    $category = new ModelsCategory();
    $category->name = $this->name;
    $saved = $category->save();

    if ($saved) {
      $this->dispatchBrowserEvent('closeModal');
      $this->resetInput();
      $this->toastr('success', 'Category has been added successfully.');
    }
  }

  public function edit($id) {
    $this->edit_id = $id;
    $this->name = ModelsCategory::find($id)->name;
    $this->dispatchBrowserEvent('showModal');
  }

  public function update() {
    $this->validate([
      'name' => 'required|unique:categories,name,' . $this->edit_id
    ]);

    $category =  ModelsCategory::find($this->edit_id);
    $updated = $category->update(['name' => $this->name]);

    if ($updated) {
      $this->dispatchBrowserEvent('closeModal');
      $this->resetInput();
      $this->toastr('success', 'Category has been updated successfully.');
    }
  }

  public function delete($id) {
    $this->delete_id = $id;
    $this->dispatchBrowserEvent('openDeleteModal');
  }

  public function deleteConfirm() {
    if ($this->delete_id) {

      $category = ModelsCategory::find($this->delete_id);


      if (count($category->posts) > 0) {
        $this->dispatchBrowserEvent('closeModalDelete');
        $this->toastr('error', 'This category is related to (' . count($category->posts) . ') post' . (count($category->posts) === 1 ? '' : 's') . '. You cannot delete it.');
      } else {
        $deleted = $category->delete();
        if ($deleted) {
          $this->dispatchBrowserEvent('closeModalDelete');
          $this->resetInput();
          $this->toastr('success', 'Category has been deleted successfully.');
        }
      }
    }
  }

  protected function toastr($status, $message) {
    $this->dispatchBrowserEvent($status, ['message' => $message]);
  }

  public function resetInput() {
    $this->name = '';
    $this->edit_id = '';
    $this->delete_id = '';
  }

  public function resetModalForm() {
    $this->resetErrorBag();
    $this->resetInput();
  }

  public function render() {
    $categories = ModelsCategory::latest()->paginate(5);
    return view('livewire.category', ['categories' => $categories]);
  }
}
