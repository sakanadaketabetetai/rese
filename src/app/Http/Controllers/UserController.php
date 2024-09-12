<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function admin_index(){
        return view('admin.admin_all');
    }

    public function admin_users(){
        $users = User::all();
        return view('admin.admin_users', compact('users'));
    }
}
