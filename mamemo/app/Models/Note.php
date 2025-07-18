<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Note extends Model
{
    protected $keyType = 'string';

    public $incrementing = false;

    protected $table = 'note';

    protected $fillable = [
        'id',
        'content',
        'page',
        'book_id',
    ];

    public static function booted() {
        static::creating(function ($model) {
            $model->id = Str::uuid();
        });
    }
}
