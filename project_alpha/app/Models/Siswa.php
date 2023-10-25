<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
	protected $fillable = ['nis','nama','jenis_kelamin','tempattanggal_lahir','alamat','notelp'];
	protected $table = 'siswa';
	public $timestamps = false;
}
