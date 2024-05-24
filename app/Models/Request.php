<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function proposals(){
        return $this->hasMany(Proposal::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
