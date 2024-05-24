<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfigHome extends Model
{
    use HasFactory;

    protected $table = "config_home";

    protected $fillable = ['title', 'description', 'header_image', 'status1', 'category_ids', 'popular_categories_filter', 'status2', 'market_place_manual_categories', 'market_place_filter', 'status3', 'seller_ids', 'seller_filter', 'status4', 'gig_ids', 'gigs_filter'];
}
