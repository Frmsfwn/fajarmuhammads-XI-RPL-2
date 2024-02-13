<?php

namespace App\Http\Controllers;

use App\Models\katalog;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Session;

class katalogController extends Controller
{
    public function index() 
    {
    
        return view('katalog.index');

    }
}
