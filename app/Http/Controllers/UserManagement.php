<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;

class UserManagement extends Controller
{
    public function __construct()
    {
        $this->middleware('isAdmin');
    }


    public function all_users(){
        $data['users'] = User::all();
        return view('admin.user.all',$data);
    }
}
