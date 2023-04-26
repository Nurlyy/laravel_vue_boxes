<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    public function saveAdmin(Request $request)
    {
        $admin = User::all()->first();

        $email = $request->email;
        $username = $request->username;
        $password = $request->password;

        if ($email != null) {
            $admin->update([
                'email' => $email,
            ]);
        }

        if($username != null){
            $admin->update([
                'username' => $username,
            ]);
        }

        if ($password != null && strlen($password) > 8) {
            $admin->update([
                'password' => $password,
            ]);
        }

        return response()->json($admin);
    }

    public function getAdmin()
    {
        $admin = User::all()->first();
        return response()->json($admin);
    }
}
