<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryDetail extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'tagline', 'cover_photo', 'icon'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
