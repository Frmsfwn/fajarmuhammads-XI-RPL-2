<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Session;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
		$data = siswa::orderBy('nis','desc')->get();
        return view('siswa.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('siswa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
		Session::flash('nis',$request->nis);
		Session::flash('nama',$request->nama);
		Session::flash('jenis_kelamin',$request->jenis_kelamin);
		Session::flash('tmpt_lahir',$request->tmpt_lahir);
		Session::flash('tgl_lahir',$request->tgl_lahir);
		Session::flash('alamat',$request->alamat);
		Session::flash('notelp',$request->notelp);
		
		$request->validate([
			'nis'=>'required|numeric|unique:siswa,nis',
			'nama'=>'required',
			'jenis_kelamin'=>'required',
			'tmpt_lahir'=>'required',
			'tgl_lahir'=>'required',
			'alamat'=>'required',
			'notelp'=>'required',
		],[
			'nis.required'=>'NIS belum diisi!',
			'nis.numeric'=>'NIS wajib terdiri dari angka!',
			'nis.unique'=>'NIS tidak dapat sama!',
			'nama.required'=>'Nama belum diisi!',
			'jenis_kelamin.required'=>'Jenis Kelamin belum diisi!',
			'tmpt_lahir.required'=>'Tempat Lahir belum diisi!',
			'tgl_lahir.required'=>'Tanggal Lahir belum diisi!',
			'alamat.required'=>'Alamat belum diisi!',
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
        $data = siswa::where('nis',$id)->first();
		return view('siswa.edit')->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    
	public function update(Request $request, string $id)
    {   
        $request->validate([
            "nis" => [
                "required",
                Rule::unique('siswa','nis')->ignore($id, 'nis'),'numeric'
            ],
			
			'nama'=>'required',
			'jenis_kelamin'=>'required',
			'tmpt_lahir'=>'required',
			'tgl_lahir'=>'required',
			'alamat'=>'required',
			'notelp'=>'required',
        ],[
			'nis.required'=>'NIS belum diisi!',
			'nis.numeric'=>'NIS wajib terdiri dari angka!',
			'nis.unique'=>'NIS tidak dapat sama!',
			'nama.required'=>'Nama belum diisi!',
			'jenis_kelamin.required'=>'Jenis Kelamin belum diisi!',
			'tmpt_lahir.required'=>'Tempat Lahir belum diisi!',
			'tgl_lahir.required'=>'Tanggal Lahir belum diisi!',
			'alamat.required'=>'Alamat belum diisi!',
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
        siswa::where("nis",$id)->update($data);
        return redirect()->to('siswa')->with('Berhasil','Data Berhasil Dirubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        siswa::where('nis',$id)->delete();
		return redirect()->to('siswa')->with('Berhasil','Berhasil Menghapus Data');
    }
}
