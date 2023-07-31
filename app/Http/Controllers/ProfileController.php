<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller {
  /**
   * Display the user's profile form.
   */
  public function edit(Request $request): View {
    return view('profile.edit', [
      'user' => $request->user(),
    ]);
  }

  /**
   * Update the user's profile information.
   */
  public function update(ProfileUpdateRequest $request): RedirectResponse {
    $request->user()->fill($request->validated());

    if ($request->user()->isDirty('email')) {
      $request->user()->email_verified_at = null;
    }

    $request->user()->save();

    return Redirect::route('profile.edit')->with('success', 'Profile updated successfully.');
  }

  /**
   * Delete the user's account.
   */
  public function destroy(Request $request): RedirectResponse {
    $request->validateWithBag('userDeletion', [
      'password' => ['required', 'current_password'],
    ]);

    $user = $request->user();

    Auth::logout();

    $user->delete();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return Redirect::to('/');
  }

  public function uploadProfile(Request $request) {
    $request->validate([
      'profile' => 'image|mimes:jpeg,png,jpg,gif',
    ]);
    $file = $request->profile;
    $extension = $file->extension();
    $filename = time() . rand(0, 100000) . '.' . $extension;

    $file->storeAs('public/profile_img', $filename);
    $user = User::find(auth()->user()->id);
    $oldFile = $user->profile;

    if ($oldFile) File::delete('storage/profile_img/' . $oldFile);

    $updated = $user->update(['profile' => $filename]);

    if ($updated) {
      return redirect()->route('profile.edit')->with('success', 'Profile image updated successfully.');
    } else {
      return redirect()->route('profile.edit')->with('error', 'Something went wrong.');
    }
  }
}
