<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        try {
            $this->authorize('showAny', User::class);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Safi ghayarha 🤷‍♂️'
            ]);
        }

        $users = User::all();

        return response()->json([
            'users' => $users
        ]);

        // return response()->json(['msg' => auth()->user()->email]);
    }
}
