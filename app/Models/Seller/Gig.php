<?php

namespace App\Models\Seller;

use App\Enums\PackageType;
use App\Models\Category;
use App\Models\Order\Order;
use App\Models\Seller\GigService;
use App\Models\Review;
use App\Models\Seller\GigStat;
use App\Models\Seller\Seller;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gig extends Model
{
    use HasFactory;

    protected $fillable = [
        'is_approved',
        'package_type',
        'seller_id',
        'is_active'
    ];

    protected $casts = [
        'package_type' => PackageType::class
    ];

    // one to many realtion with seller
    public function seller() {
        return $this->belongsTo(Seller::class);
    }

    // one to one relation with gig details
    public function gigDetail() {
        return $this->hasOne(GigDetail::class);
    }

    // one to one relation with stats
    public function gigStat() {
        return $this->hasOne(GigStat::class);
    }

    // one to many relation with images
    public function gigImages() {
        return $this->hasMany(GigImage::class);
    }

    // many to many relation with tags
    public function tags() {

        return $this->belongsToMany(Tag::class);
    }

    // one to many relation with gig packages
    public function gigPackages() {
        return $this->hasMany(GigPackage::class);
    }

    // get min package price for gig startedAT
    public function minPackagePrice()
    {
        return $this->gigPackages()->min('price');
    }

    // one to many relation with faqs
    public function gigFaqs() {
        return $this->hasMany(GigFaq::class);
    }

    public function gigRequirements() {
        return $this->hasMany(GigRequirement::class);
    }

    // gig reviews
    public function gigReviews() {
        return $this->hasMany(Review::class);
    }

    public function categories() {
        return  $this->belongsToMany(Category::class)->withPivot(['level']);
    }

    public function mainImage() {
        return $this->hasOne(GigImage::class)->where('image_type', 'M');
    }

    public function gigServices() {
        return $this->belongsToMany(GigService::class);
    }

    public function orders() {
        return $this->hasMany(Order::class);
    }

    public function portfolio() {
        return $this->hasMany(GigPortfolio::class);
    }

}
