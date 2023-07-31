<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSetting extends Model
{
    protected $guarded = ['id'];
    public $timestamps=false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
