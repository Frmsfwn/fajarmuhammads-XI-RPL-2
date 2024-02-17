<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    protected $fillable = ['id','nama_produk','gambar_produk','thumbnail_produk','link_produk','deskripsi_produk','harga_produk'];
	protected $table = 'product';
	public $timestamps = false;
}
