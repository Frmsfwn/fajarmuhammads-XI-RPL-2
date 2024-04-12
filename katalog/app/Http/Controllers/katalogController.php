<?php

namespace App\Http\Controllers;

use App\Models\comment;
use App\Models\product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class katalogController extends Controller
{
    function index() 
    {
        return view('katalog.index');
    }
    function homepage()
    {
        $currentuser = Auth::user();
        $iduser = Auth::id();
        $dataproduct = product::all();
        $datacomment = comment::all();

        return view('katalog.homepage')->with('datauser', $currentuser)->with('iduser', $iduser)
        ->with('dataproduct', $dataproduct)->with('datacomment', $datacomment);
    }
    function dashboard()
    {
        $dataproduct = product::all();
        $datauser = user::all();
        return view('katalog.dashboard')->with('dataproduct', $dataproduct)
        ->with('datauser', $datauser);
    }
}
