<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function index() {
        return view('users.index');
    }

    public function changePassword($id){
        return view('users.changepassword', compact('id'));
    }

    public function edit($id) {
        $user = User::find($id);
        return view('users.edit', compact('user'));
    }

    public function update() {
        $name      = request('name');
        $email     = request('email');
        $userId    = request('id');
        $role    = request('role');

        $check = User::where('email', $email)->where('id', '!=', $userId)->count();

        if ($check == 0) {
            $u = User::find($userId);
            $u->name        = $name;
            $u->email       = $email;
            $u->role        = $role;
            $u->save();
            return response()->json([
                "error" => false,
                "msg"   => "Successfully saved!"
            ]);
        } else {
            return response()->json([
                "error" => true,
                "msg"   => "User exists!"
            ]);
        }
    }

    public function savePassword()
    {

        $id    = request('userId');
        $password  = request('password');

        $user = User::find($id);
        $user->password = bcrypt($password);
        $user->save();
    }

    public function destroy($id)
    {
        User::find($id)->delete();
    }

    public function changeStatus($id)
    {
        $changeTo = request('title');
        if ($changeTo == "Activate User") {
            $user = User::find($id);
            $user->active = 1;
            $user->save();
        } else {
            $user = User::find($id);
            $user->active = 0;
            $user->save();
        }
    }

    public function save(){
        $name     = request('name');
        $email    = request('email');
        $role     = request('role');
        $password = request('upassword');

        $check = User::where('email', $email)->count();

        if ($check == 0) {
            $u = new User;
            $u->name        = $name;
            $u->email       = $email;
            $u->password    = bcrypt($password);
            $u->role        = $role;
            $u->save();
            return response()->json([
                "error" => false,
                "msg"   => "Successfully saved!"
            ]);
        } else {
            return response()->json([
                "error" => true,
                "msg"   => "User exists!"
            ]);
        }
    }
}
