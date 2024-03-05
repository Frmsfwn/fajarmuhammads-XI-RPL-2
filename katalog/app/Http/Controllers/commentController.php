<?php

namespace App\Http\Controllers;

use App\Models\comment;
use Illuminate\Http\Request;

class commentController extends Controller
{
    function addcomment()
    {
        return view('katalog.comment');
    }
    function storecomment(Request $request, $id)
    {
        $data = [
            'user_id' => $request->comment,
            'product_id' => $request->comment,
            'comment' => $request->comment
        ];
        comment::create($data);
    }
}
