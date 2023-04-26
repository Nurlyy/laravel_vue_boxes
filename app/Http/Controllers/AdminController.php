<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{

    public function saveAdmin(Request $request){
        $admin = User::find($request->id)->first();

        $validatedData = $request->validate([
            'email' => 'required|max:255',
            'username' => 'required|max:255',
            'password' => 'required|max:255',
        ]);

        $admin->update([
            'email' => $validatedData['email'],
            'username' => $validatedData['username'],
            'password' => $validatedData['password'],
        ]);

        return response()->json(['admin' => $admin]);
    }

    public function getAdmin(){
        $admin = User::all()->first();
        return response()->json(['admin' => $admin]);
    }

}