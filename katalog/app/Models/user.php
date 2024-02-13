<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user extends Model
{
    use HasFactory;
    protected $fillable = ['id','username','email','password','nama','jk','notelp','role'];
	protected $table = 'user';
	public $timestamps = false;
}
