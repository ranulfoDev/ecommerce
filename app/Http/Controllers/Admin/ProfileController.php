<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    // SHOW PROFILE
    public function index()
    {
        return view('pages.admin.profile', [
            'title' => 'Profile'
        ]);
    }

    // UPDATE PROFILE
public function update(Request $request)
{
    $user = auth()->user();

    $request->validate([
        'name' => 'required',
        'email' => 'required|email',
        'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048'
    ]);

    // UPDATE BASIC INFO
    $user->name = $request->name;
    $user->email = $request->email;

    // UPLOAD IMAGE WITH OLD IMAGE CLEANUP
    if ($request->hasFile('image')) {

        // DELETE OLD IMAGE IF EXISTS
        if ($user->image && Storage::disk('public')->exists($user->image)) {
            Storage::disk('public')->delete($user->image);
        }

        // SAVE NEW IMAGE
        $path = $request->file('image')->store('profiles', 'public');
        $user->image = $path;
    }

    $user->save();

    return back()->with('success', 'Profile updated successfully!');
}
}