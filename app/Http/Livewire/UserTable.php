<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class UserTable extends Component {
  public $role, $search, $order;
  use WithPagination;

  public function mount() {
    $this->resetPage();
  }


  public function render() {

    $query = User::query();

    if ($this->role) {
      $this->resetPage();
      $query->where('role', $this->role);
    }

    if ($this->search) {
      $query->where('name', 'LIKE', '%' . $this->search . '%');
    }

    if ($this->order) {
      $query->orderBy('name', $this->order);
    }

    $users = $query->where('id', '!=', Auth::id())->paginate(10);



    return view('livewire.user-table', ['users' => $users]);
  }
}
