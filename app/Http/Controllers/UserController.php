<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function createUser()
    {
        $user = User::factory()->make();
        $user->save();

        return response()->json($user);
    }
}
