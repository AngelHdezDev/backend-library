<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;



class UserController extends Controller
{


    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    public function create()
    {
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',

        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        $role = Role::findByName($request->role);
        Log::info('Nombre del rol', [$role]);
        $user->assignRole($role);


        return response()->json([
            'message' => 'User created successfully.',
            'user' => $user
        ], 201);
    }


    public function edit(User $user)
    {
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6',
            'role' => 'required|exists:roles,name',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
            'role' => $request->role,
        ]);

        $user->syncRoles($request->role);

        return response()->json([
            'message' => 'User edited successfully.',
            'user' => $user
        ], 201);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response()->json([
            'message' => 'User elimitaned successfully.',
            'user' => $user
        ], 201);
    }
}
