<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MaintenanceController extends Controller
{
    public function create()
    {
        $user = Auth::user();
        $user_id = $user->id;

        // Retrieve the units for the tenant
        $units = Unit::join('contacts', 'units.contacts_tenant_id', '=', 'contacts.id')
            ->join('users', 'users.contact_id', '=', 'contacts.id')
            ->select('units.id', 'units.unit_number', 'units.unit_name')
            ->where('users.id', $user_id)
            ->get();

        return view('maintenance.request-maintenance', ['units' => $units]);
    }

    public function store(Request $request)
    {
        // Logic to store the maintenance request

        return redirect()->back()->with('success', 'Maintenance request submitted successfully.');
    }
}
