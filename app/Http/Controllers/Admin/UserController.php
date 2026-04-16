<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;

class UserController extends Controller
{
    // 👥 VIEW ALL USERS
    public function index()
    {
        $users = User::latest()->paginate(10);

        return view('pages.admin.users.index', compact('users'));
    }

    // 🚫 BLOCK USER
    public function block($id)
    {
        $user = User::findOrFail($id);
        $user->status = 'blocked'; // make sure may column ka na status
        $user->save();

        return back()->with('success', 'User blocked successfully');
    }

    // ✅ ACTIVATE USER
    public function activate($id)
    {
        $user = User::findOrFail($id);
        $user->status = 'active';
        $user->save();

        return back()->with('success', 'User activated successfully');
    }

    // 📦 VIEW USER ORDERS
    public function orders($id)
    {
        $user = User::findOrFail($id);

        $orders = Order::where('user_id', $id)
            ->latest()
            ->paginate(10);

        return view('pages.admin.users.orders', compact('user', 'orders'));
    }

    public function destroy($id)
{
    User::findOrFail($id)->delete();

    return back()->with('success', 'User deleted successfully');
}

}
