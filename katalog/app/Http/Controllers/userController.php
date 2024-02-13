<?php

namespace App\Http\Controllers;

use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Session;

class userController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('katalog.daftar');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Session::flash('username',$request->username);
		Session::flash('email',$request->email);
		Session::flash('password',$request->password);
		Session::flash('nama',$request->nama);
		Session::flash('jk',$request->jk);
		Session::flash('notelp',$request->notelp);
		
		$request->validate([
			'username'=>'required',
			'email'=>'required|unique:user,email',
			'password'=>'required',
			'nama'=>'required',
			'jk'=>'required',
			'notelp'=>'required',
		],[
			'username.required'=>'Username belum diisi!',
            'email.required'=>'Email belum diisi!',
			'email.unique'=>'Email tidak dapat sama!',
			'password.required'=>'Password belum diisi!',
			'nama.required'=>'Nama belum diisi!',
			'jk.required'=>'Jenis Kelamin belum diisi!',
			'notelp.required'=>'Nomor Telepon belum diisi!',
		]);
		$data = [
			'nis' => $request->nis,
			'nama' => $request->nama,
			'jenis_kelamin' => $request->jenis_kelamin,
			'tmpt_lahir' => $request->tmpt_lahir,
			'tgl_lahir' => $request->tgl_lahir,
			'alamat' => $request->alamat,
			'notelp' => $request->notelp,
		];
		siswa::create($data);
        return redirect()->to('siswa')->with('Berhasil','Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
