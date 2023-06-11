<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use app\Models\Notification;
use app\Models\User;
use app\Models\WorkOrder;

class Maintenance extends Model
{
    protected $table = 'maintenance';

    protected $fillable = [
        'maintenance_number',
        'user_id',
        'unit_number',
        'unit_name',
        'description',
        'category',
        'status',
        'photo',
        'maintenance_photo_path',
        'remarks',
        'feedback',
        'assessment'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function workorder()
    {
        return $this->hasOne(WorkOrder::class);
    }

    public function notification()
    {
        return $this->hasOne(Notification::class);
    }
}
