<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        // check if the user has the ability to see all users
        abort_if(Gate::denies('showAny', User::class), 401, 'Unauthorized');

        $users = User::all();

        return UserResource::collection($users);
    }

    public function show(User $user)
    {
        // Check if the user has the abilty to see a specific user
        abort_if(Gate::denies('show', User::class), 401, 'Unauthorized');

        return response()->json([
            'user' => (new UserResource($user))
        ]);
    }

    public function store(Request $request)
    {
        // Check if the user has the abilty to see a specific user
        abort_if(Gate::denies('show', User::class), 401, 'Unauthorized');

        // Validate the request
        $request->validate([
            'name' => 'required|min:5',
            'email' => 'required|email|unique:users,email',
            'roles' => 'required|array'
        ]);
        // store the user in the database
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make("password")
        ]);
        // assign role to te user
        $user->syncRoles($request->roles);

        return response()->json([
            'user' => (new UserResource($user))
        ]);
    }

    public function update(Request $request, User $user)
    {
        // Validate the request
        $request->validate([
            'name' => 'min:5',
            'email' => 'email',
            'roles' => 'array'
        ]);
        // update the user
        $user->update([
            'name' => $request->name,
            'email' => $request->email
        ]);
        // update user roles
        $user->syncRoles($request->roles);

        return response()->json([
            'user' => (new UserResource($user))
        ]);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return response()->json([
            'message' => 'User deleted'
        ]);
    }
}
