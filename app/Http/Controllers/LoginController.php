<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    //
    public function login()
    {
        return view('app.login');
    }
    
    public function logout()
    {
        return view('app.login');
    }

}