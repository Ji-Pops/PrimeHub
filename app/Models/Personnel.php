<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Personnel extends Model
{
    protected $table = 'personnel';

    protected $fillable = [
        'first_name',
        'last_name'	,
        'email'	,
        'phone_number' ,
        'department' ,

    ];
}
