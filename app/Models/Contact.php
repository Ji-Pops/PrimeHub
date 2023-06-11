<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'contacts';

    protected $fillable = [
        'user_type',
        'first_name',
        'last_name',
        'email',
        'phone',
        'profile_picture',
        'profile_picture_path',
    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function unit()
    {
        return $this->hasOne(Unit::class);
    }
}
