<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfigBasic extends Model
{
    use HasFactory;

    protected $fillable = ['site_title', 'logo_image', 'fav_icon'];
}
