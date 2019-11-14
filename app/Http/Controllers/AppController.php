<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppController extends Controller
{
    //
    public function doLogin()
    {
        $data = [
            "email"     => request("email"),
            "password"  => request("password"),
            "active"    => 1
        ];

        $credtx = auth()->attempt($data);

        if ($credtx) {
            return redirect()->intended('/app/dashboard');
        } else {
            return redirect()->back()->with('error', 'Invalid User');
        }
    }

    public function dashboard()
    {
        return view('app.dashboard');
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->to('/login')->with('success', 'Successfully Logout');
    }

    public function redirectWith()
    {
        return redirect()->back()->with('success', 'Successfully saved!');
    }

    public function redirectWithDelete()
    {
        return redirect()->back()->with('success', 'Successfully deleted!');
    }
}
