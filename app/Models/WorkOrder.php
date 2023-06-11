<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkOrder extends Model
{
    protected $table = 'work_orders';

    protected $fillable = [
        'work_order_number',
        'maintenance_id',
        'unit_name',
        'description',
        'department',
        'status',
        'notes',
        'personnel',
        'approved_by_full_name',
        'created_at',
        'updated_at',
    ];

    public function maintenance()
    {
        return $this->belongsTo(Maintenance::class, 'maintenance_id');
    }
}
