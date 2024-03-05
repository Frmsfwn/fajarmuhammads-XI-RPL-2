<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\user;
use Illuminate\Http\Request;

class admincontroller extends Controller
{
    function index()
    {
    
    }
    function show()
    {
        $dataproduct = product::all();
        $datauser = user::all();
        return view('katalog.dashboard')->with('dataproduct', $dataproduct)
        ->with('datauser', $datauser);
    }
    function deleteuser(user $user)
    {
        user::destroy($user->id);
        return redirect(route('admin.dashboard'))->with('success', 'User Deleted!');
    }
}
