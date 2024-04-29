<?php

namespace App\Http\Controllers;

use App\Models\comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class commentController extends Controller
{
    function storecomment(Request $request, $id)
    {
        $currentuser = Auth::user();
        $iduser = Auth::id();
        $data = [
            'user_id' => $iduser,
            'product_id' => $id,
            'comment' => $request->comment
        ];
        comment::create($data);
        return redirect('/homepage');
    }
    
    function deletecomment($id)
    {
        comment::destroy($id);
        return redirect('/homepage');
    }
}
