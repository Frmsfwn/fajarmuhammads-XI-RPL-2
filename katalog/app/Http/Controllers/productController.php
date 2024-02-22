<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Models\product;
use Illuminate\Http\Request;

class productController extends Controller
{
    function addproduct()
    {
        return view('katalog.addproduct');
    }
    function storeproduct(StoreProductRequest $request)
    {   
        $imageName = time().'.'.$request->product_image->extension();
        $uploadedImage = $request->product_image->move(public_path('images'), $imageName);
        $imagePath = 'images/' . $imageName;

        $params = $request->validated();
        
        if ($product = product::create($params)) {
            $product->product_image = $imagePath;
            $product->save();

            return redirect(url('/addproduct'))->with('success', 'Added!');
        }

        /*$request->validate([
            
        ],[
            'product_name.required'     =>  'Enter Product Name!',
            'product_price.required'    =>  'Enter Product Price!',
            'product_link.required'     =>  'Enter Product Link!',
            'product_image.required'    =>  'Enter Product Image!',
            'product_desc.required'     =>  'Enter Product Description!',
        ]);
        $data = [
            'product_name'      =>  $request->product_name,
            'product_price'     =>  $request->product_price,
            'product_link'      =>  $request->product_link,
            'product_image'     =>  $request->product_image,
            'product_desc'      =>  $request->product_desc,
		];
        product::create($data);*/
    }
    function editproduct()
    {
        
    }
}
