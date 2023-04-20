<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redis;

class UserController extends Controller
{
    public function index()
    {
        // check if the user has the ability to see all users
        abort_if(Gate::denies('showAny', User::class), 401, 'Unauthorized');

        $users = User::all();

        return response()->json([
            'users' => $users
        ]);
    }

    public function show(User $user)
    {
        // Check if the user has the abilty to see a specific user
        abort_if(Gate::denies('show', User::class), 401, 'Unauthorized');
        // Get user roles
        $roles = $user->roles()->first();
        return response()->json([
            'user' => $user->toArray(),
            'roles' => $roles->only('name')
        ]);
    }

    public function create()
    {
    }

    public function store()
    {
    }

    public function edit()
    {
    }

    public function update()
    {
    }

    public function destroy()
    {
    }
}
