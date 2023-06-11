<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use app\Models\Maintenance;
use app\Models\User;


class Notification extends Model
{
    protected $table = 'notifications';

    protected $fillable = [
        'user_id',
        'maintenance_id',
        'message',
        'is_read',
        'notification_for',
    ];

    protected $casts = [
        'is_read' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function maintenance()
    {
        return $this->belongsTo(Maintenance::class);
    }
}
