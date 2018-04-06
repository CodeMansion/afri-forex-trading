<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(\Auth::user()->is_admin) {
            return view('admin.dashboard');
        }

        return view('members.dashboard');
    }


    public function registerIndex()
    {
        return view('register');
    }
}
