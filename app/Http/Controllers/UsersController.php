<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        return view ('Backoffice.users')->with('listUsers', User::orderBy('created_at','DESC')->paginate(4));
    }
}
