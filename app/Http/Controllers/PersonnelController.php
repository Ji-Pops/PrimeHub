<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Personnel;

class PersonnelController extends Controller
{
    public function personnelManagement()
    {
        $personnels = Personnel::paginate(10);
        return view('admin.personnel-management', compact('personnels'));
    }

    public function addPersonnel(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'department' => 'nullable',
            'phone' => 'nullable',
            'email' => 'nullable|email',
        ]);
    
        $personnel = new Personnel();
        $personnel->first_name = $validatedData['first_name'];
        $personnel->last_name = $validatedData['last_name'];
        $personnel->department = $validatedData['department'];
        $personnel->phone = $validatedData['phone'];
        $personnel->email = $validatedData['email'];
        $personnel->save();
    
        session()->flash('success', true);
        session()->flash('added_success_message', 'Personnel Added');
        
        return redirect()->route('admin.personnel-management');
    }    

    public function deletePersonnel(Personnel $personnel)
    {
        $personnel->delete();

        session()->flash('success', true);
        session()->flash('deleted_success_message', 'Personnel Deleted');
        
        return redirect()->route('admin.personnel-management');
    }
}