<?php

namespace App\Http\Controllers;

use App\Models\comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class commentController extends Controller
{
    function storecomment(Request $request, $id)
    {
        $currentuser = Auth::user();
        $iduser = Auth::id();
        $data = [
            'id' => IdGenerator::generate(['table' => 'comment', 'length' => 10, 'prefix' =>'COMM-', 'reset_on_prefix_change'=>true]), 
            'user_id' => $iduser,
            'product_id' => $id,
            'comment' => $request->comment
        ];
        comment::create($data);
        return redirect('/homepage');
    }
}
