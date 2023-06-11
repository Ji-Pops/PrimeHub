<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Unit;
use App\Models\Contact;

class UnitController extends Controller
{
    public function unit_Management()
    {
        $contacts = Contact::where('user_type', '=', 'tenant')->get();

        $units = Unit::paginate(10);
        return view('admin.unit-management', compact('units', 'contacts'));
    }

    public function addUnit(Request $request)
    {
        $validatedData = $request->validate([
            'unit_number' => 'required',
            'unit_name' => 'nullable',
            'contacts_tenant_id' => 'nullable',
        ]);
    
        $unit = new Unit();
        $unit->unit_number = $validatedData['unit_number'];
        $unit->unit_name = $validatedData['unit_name'] ?? 'Not Assigned';
        $unit->contacts_tenant_id = $validatedData['contacts_tenant_id'];
        $unit->save();
    
        session()->flash('success', true);
                session()->flash('added_success_message', 'Unit Added');
        // Redirect back to the unit management page
        return redirect()->route('admin.unit-management');
    }    

    public function deleteUnit(Unit $unit)
    {
        // Delete any associated data or perform necessary data manipulation here
        // For example, you can delete related records from other tables

        $unit->delete();

        session()->flash('success', true);
                session()->flash('deleted_success_message', 'Unit Deleted');
        // Redirect back to the unit management page
        // Redirect back to the unit management page with success message
        return redirect()->route('admin.unit-management');
    }
}
