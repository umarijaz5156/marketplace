<?php

namespace App\Models;


use App\Models\Seller\Gig;
use App\Models\Seller\GigStat;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description','parent_id'];

    public function parentCategory() {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function childCategories() {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function gigs() {
        return $this->belongsToMany(Gig::class);
    }

    public function detail() {
        return $this->hasOne(CategoryDetail::class);
    }
    
    public function categoryDetails()
    {
        return $this->hasOne(CategoryDetail::class);
    }
}
