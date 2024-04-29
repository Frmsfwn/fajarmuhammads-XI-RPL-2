<?php

namespace App\Http\Controllers;

use App\Models\like;
use App\Models\product;
use Illuminate\Http\Request;

class productController extends Controller
{
    function addproduct()
    {
        return view('katalog.addproduct');
    }
    function storeproduct(Request $request)
    {   
        $request->validate([
            'product_name'      =>  'required',
            'product_price'     =>  'required',
            'product_link'      =>  'required',
            'product_image'     =>  'required|image|max:2048',
        ],[
            'product_name.required'     =>  'Enter Product Name!',
            'product_price.required'    =>  'Enter Product Price!',
            'product_link.required'     =>  'Enter Product Link!',
            'product_image.required'    =>  'Enter Product Image!',
            'product_image.image'    =>  'File Must be Image!',
            'product_image.max'    =>  'Maximum Image File Size is 2MB!'
        ]);

        $image = $request->file('product_image');
        $imageName = time().'.'.$image->extension();
        $image->move(public_path('images'), $imageName);
        $imagePath = 'images/' . $imageName;

        product::create([
            'product_name' => $request->product_name,
            'product_price' => $request->product_price,
            'product_link' => $request->product_link,
            'product_image' => $imagePath
        ]);

        return redirect('/dashboard')->with('success', 'Product Added!');
    }
    function editproduct(string $id)
    {
        $dataproduct = product::findorFail($id);

        return view('katalog.editproduct')->with('dataproduct', $dataproduct);
    }
    function updateproduct(Request $request, $id)
    {
        $request->validate([
            'product_name'      =>  'required',
            'product_price'     =>  'required',
            'product_link'      =>  'required',
            'product_image'     =>  'image|max:2048',
        ],[
            'product_name.required'     =>  'Enter Product Name!',
            'product_price.required'    =>  'Enter Product Price!',
            'product_link.required'     =>  'Enter Product Link!',
            'product_image.image'    =>  'File Must be Image!',
            'product_image.max'    =>  'Maximum Image File Size is 2MB!'
        ]);
        $data = [
            'product_name' => $request->product_name,
            'product_price' => $request->product_price,
            'product_link' => $request->product_link
        ];

        $image = product::findOrFail($id);

        if ($request->hasFile('product_image')) {

            unlink($image->product_image);

            $newImage = $request->file('product_image');
            $imageName = time().'.'.$newImage->extension();
            $newImage->move(public_path('images'), $imageName);

            $image->product_image = 'images/' . $imageName;
        }
        product::where('id', $id)->update($data);
        $image->save();

        return redirect(route('admin.dashboard'))->with('success', 'Product Updated!');
    }
    function deleteproduct(product $product)
    {

        $host="localhost";
        $user="root";
        $pswd="";
        $database="katalog_db";
        $koneksi=mysqli_connect($host, $user, $pswd, $database);

        $image = product::findorFail($product->id);

        product::destroy($product->id);
        unlink($image->product_image);

        mysqli_query($koneksi, "ALTER TABLE product DROP id");
        mysqli_query($koneksi, "ALTER TABLE product ADD id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST");
        mysqli_query($koneksi, "ALTER TABLE product ADD UNIQUE (id)");

        return redirect(route('admin.dashboard'))->with('success', 'Product Deleted!');
    }
    function addlike(product $product)
    {
        $user_id = auth()->user()->id;

        $Like = like::where('user_id', $user_id)
                            ->where('product_id', $product->id)
                            ->first();
        if($Like){
            $Like->delete();
        } else {
            $like = new like();
            $like->product_id = $product->id;
            $like->user_id = $user_id;
            $like->save();
        }

        return redirect('/homepage');
    }
    function deletelike(product $product)
    {
        $user_id = auth()->user()->id;

        $Like = like::where('user_id', $user_id)
                            ->where('product_id', $product->id)
                            ->first();

        $Like->delete();

        return redirect('/homepage');
    }
}
