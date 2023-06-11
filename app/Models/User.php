<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Contact;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'username',
        'password',
        'user_type',
        'contact_id',
    ];

    public function contact()
    {
        return $this->belongsTo(Contact::class, 'contact_id');
    }

    public function maintenance()
    {
        return $this->hasOne(Maintenance::class);
    }

    public function notification()
    {
        return $this->hasOne(Notification::class);
    }
}
