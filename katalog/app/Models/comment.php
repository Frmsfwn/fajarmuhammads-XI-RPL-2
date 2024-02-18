<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    protected $fillable = ['id','produk_id','user_id','comment'];
	protected $table = 'comment';
	public $timestamps = false;
}
