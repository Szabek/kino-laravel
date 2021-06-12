<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

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
        return $this->hasOne(Category::class);
    }
}
