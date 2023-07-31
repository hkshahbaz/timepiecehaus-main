<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    protected $dates = ['deleted_at'];
    protected $casts = [
        'payment_done_at' => 'datetime',
        'deliver_at' => 'datetime',
        'received_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    public function vendor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // type = product
    public function productPictures()
    {
        return $this->hasMany(ProductPicture::class)->where('type', 'product');
    }

    // type = ownership
    public function productOwnershipPictures()
    {
        return $this->hasMany(ProductPicture::class)->where('type', 'ownership');
    }

    public function condition()
    {
        return $this->belongsTo(Condition::class);
    }

    public function deliveryScope()
    {
        return $this->belongsTo(DeliveryScope::class);
    }

    public function productType()
    {
        return $this->belongsTo(ProductType::class);
    }

    public function movement()
    {
        return $this->belongsTo(Movement::class);
    }

    public function glassType()
    {
        return $this->belongsTo(GlassType::class);
    }

    public function caseMaterial()
    {
        return $this->belongsTo(CaseMaterial::class);
    }

    public function bezelMaterial()
    {
        return $this->belongsTo(BezelMaterial::class);
    }

    public function waterResistance()
    {
        return $this->belongsTo(WaterResistance::class);
    }

    public function dial()
    {
        return $this->belongsTo(Dial::class);
    }

    public function dialNumeral()
    {
        return $this->belongsTo(DialNumeral::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function currency()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function braceletMaterial()
    {
        return $this->belongsTo(BraceletMaterial::class);
    }

    public function braceletColor()
    {
        return $this->belongsTo(BraceletColor::class, 'bracelet_color_id');
    }

    public function claspType()
    {
        return $this->belongsTo(ClaspType::class);
    }

    public function claspMaterial()
    {
        return $this->belongsTo(ClaspMaterial::class);
    }

    public function productFunctions()
    {
        return $this->belongsToMany(ProductFunction::class, 'product_product_function', 'product_id', 'product_function_id');
    }

    public function dialFeatures()
    {
        return $this->belongsToMany(DialFeature::class, 'product_dial_feature', 'product_id', 'dial_feature_id');
    }

    public function handDetails()
    {
        return $this->belongsToMany(HandDetail::class, 'product_hand_detail', 'product_id', 'hand_detail_id');
    }

    public function caseMoreSettings()
    {
        return $this->belongsToMany(MoreSetting::class, 'product_more_setting', 'product_id', 'more_setting_id')
            ->where('type', 'case');
    }

    public function caliberMoreSettings()
    {
        return $this->belongsToMany(MoreSetting::class, 'product_more_setting', 'product_id', 'more_setting_id')
            ->where('type', 'caliber');
    }

    public function productRatings()
    {
        return $this->hasMany(ProductRating::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    // one product can have multiple wish lists
    public function wishLists()
    {
        return $this->hasMany(WishList::class);
    }

    //one product can be added from different user in wish list
    public function wishListUsers()
    {
        return $this->belongsToMany(User::class, 'wish_lists', 'product_id', 'user_id');
    }
    public function suspiciousReports(){
        return $this->hasMany(SuspiciousReport::class);
    }
}
