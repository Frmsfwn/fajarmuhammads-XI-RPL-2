<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Book extends Model
{
    protected $keyType = 'string';

    public $incrementing = false;

    protected $table = 'book';

    protected $fillable = [
        'id',
        'user_id',
        'title',
        'description',
        'book_color',
    ];

    public static function booted() {
        static::creating(function ($model) {
            $model->id = Str::uuid();
        });
    }
}
