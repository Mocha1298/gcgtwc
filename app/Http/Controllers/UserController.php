<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function show()
    {
        $data = User::all();
        return view("user",['data'=>$data]);
    }
}