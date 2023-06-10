<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        // check if the user has the ability to see all users
        abort_if(Gate::denies('showAny', User::class), 401, 'Unauthorized');

        $users = User::all();

        return UserResource::collection($users);
    }

    public function show($id)
    {
        // Check if the user has the abilty to see a specific user
        abort_if(Gate::denies('show', User::class), 401, 'Unauthorized');

        try {
            $user = User::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => "The user not found"
            ], 404);
        }
        return response()->json([
            'user' => (new UserResource($user)),
        ]);
    }

    public function store(UserRequest $request)
    {
        // Check if the user has the abilty to see a specific user
        abort_if(Gate::denies('show', User::class), 401, 'Unauthorized');

        // Retrieve the file path
        $path = Storage::putFile('images', $request->file('photo'));

        // store the user in the database
        $user = User::create([
            'first_name' => $request->name,
            'last_name' => $request->prenom,
            'photo' => basename($path),
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'password' => Hash::make('password'),
        ]);

        // assign role to te user
        $user->syncRoles($request->roles);

        return response()->json([
            'user' => (new UserResource($user)),
        ]);
    }

    public function update(UserRequest $request, User $user)
    {
        // Retrieve the file path
        $path = Storage::putFile('images', $request->file('photo'));

        // update the user
        $user->update([
            'first_name' => $request->nom,
            'last_name' => $request->prenom,
            'photo' => basename($path),
            'email' => $request->email,
        ]);

        // update user roles
        $user->syncRoles($request->roles);

        return response()->json([
            'user' => (new UserResource($user)),
        ]);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return response()->json([
            'message' => 'User deleted',
        ]);
    }
}
