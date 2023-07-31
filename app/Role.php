<?php

namespace App;

use Laratrust\Models\LaratrustRole;

class Role extends LaratrustRole
{
    protected $guarded = ['id'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'role_user');
    }
}
