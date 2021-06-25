<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Movie extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'category_id',
        'author',
        'description',
        'trailer',
        'release_date',
        'picture_source'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
