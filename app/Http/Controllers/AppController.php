<?php

namespace App\Http\Controllers;

class AppController extends Controller
{
    public function dashboard()
    {
        return view('dashboard');
    }

    public function fail()
    {
        return view('fail');
    }

    public function recaps()
    {
        return view('recaps');
    }

    public function register()
    {
        return view('register');
    }

    public function verify()
    {
        return view('verify');
    }

    public function schedule()
    {
        return view('schedule');
    }
}
