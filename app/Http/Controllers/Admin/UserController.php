<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller {


  public function index() {
    // $users = User::where('id', '!=', auth()->user()->id)->latest()->get();
    return view('admin.users');
  }

  public function edit($id) {
    $user = User::find($id);
    return view('admin.user-edit', ['user' => $user]);
  }

  public function update($id, Request $request) {
    $user = User::find($id);
    $user->update([
      'name' => $request->name,
      'email' => $request->email,
      'role' => $request->role,
    ]);

    return redirect()->route('admin.users')->with('success', 'Updated user successfully.');
  }

  public function delete($id) {
    User::find($id)->delete();
    return redirect()->route('admin.users')->with('success', 'Deleted user successfully.');
  }
}
