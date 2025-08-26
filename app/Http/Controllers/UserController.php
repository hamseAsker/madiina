<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
        $users = User::all();
        return view('users.index', compact('users'));
    }
    public function create() {
        $roles = \App\Models\Role::all();
        return view('users.create', compact('roles'));
    }
    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'role_id' => 'required|exists:roles,id',
        ]);
        $user = new \App\Models\User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role_id = $request->role_id;
        $user->save();
        return redirect()->route('users.index');
    }
    public function show(User $user) {
        return view('users.show', compact('user'));
    }
    public function edit(User $user) {
        $roles = \App\Models\Role::all();
        return view('users.edit', compact('user', 'roles'));
    }
    public function update(Request $request, User $user) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role_id' => 'required|exists:roles,id',
        ]);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }
        $user->role_id = $request->role_id;
        $user->save();
        return redirect()->route('users.index');
    }
    public function destroy(User $user) {
        $user->delete();
        return redirect()->route('users.index');
    }
}
