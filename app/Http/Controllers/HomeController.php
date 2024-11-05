<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    public function home()
    {
        return redirect('dashboard');
    }

    public function dashboard(){
        if(Auth::user()->role == 'admin'){
            return view('admin.dashboard');
        }
        if(Auth::user()->role == 'user'){
            return view('user.dashboard');
        }
    }
}
