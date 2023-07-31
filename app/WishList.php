<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WishList extends Model
{
    protected $guarded = ['id'];

    // one wish list belongs to only one product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // one wish list belongs to only one user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
