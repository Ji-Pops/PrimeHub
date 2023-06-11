<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use app\Models\Contact;

class Unit extends Model
{

    protected $table = 'units';

    protected $fillable = [
        'unit_number',
        'unit_name',
        'contacts_tenant_id',
    ];

    // Define the relationship with the Contact model
    public function tenant()
    {
        return $this->belongsTo(Contact::class, 'contacts_tenant_id');
    }
}
