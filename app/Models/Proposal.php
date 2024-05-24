<?php

namespace App\Models;

use App\Models\Seller\Seller;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function request(){
        return $this->belongsTo(Request::class);
    }

    public function seller(){
        return $this->belongsTo(Seller::class);
    }
}
