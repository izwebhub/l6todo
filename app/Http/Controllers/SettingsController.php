<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class SettingsController extends Controller
{
    //
    public function changePassword() {
        $password = request('password');

        $user  = User::find(auth()->user()->id);
        $user->password  = bcrypt($password);
        $user->save();

        return response()->json([
            "error" => false,
            "msg"   => "Successfully updated!"
        ]);
    }
}
