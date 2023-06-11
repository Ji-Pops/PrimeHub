<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class PasswordController extends Controller
{

    public function change_Password()

    {
        return view('admin.change-password');
    }

    public function changePassword(Request $request, $id)
    {
        // Retrieve the admin record based on the provided ID
        $admin = User::find($id);
    
        // Check if the provided current password matches the admin's password
        if (!Hash::check($request->current_password, $admin->password)) {
            return back()->withErrors(['error' => 'Current password is incorrect.'])->withInput();
        }
    
        $admin->password = bcrypt($request->new_password);
    
        try {
            $admin->save();
    
            session()->flash('success', true);
            session()->flash('changed_success_message', 'Password Changed Successfully.');
    
            return redirect()->route('admin.change-password');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Could not change the password.'])->withInput();
        }
    }    


    public function change_TenantPassword()

    {
        return view('tenant.change-password');
    }

    public function changeTenantPassword(Request $request, $id)
    {
        // Retrieve the admin record based on the provided ID
        $admin = User::find($id);
    
        // Check if the provided current password matches the admin's password
        if (!Hash::check($request->current_password, $admin->password)) {
            return back()->withErrors(['error' => 'Current password is incorrect.'])->withInput();
        }
    
        $admin->password = bcrypt($request->new_password);
    
        try {
            $admin->save();
    
            session()->flash('success', true);
            session()->flash('changed_success_message', 'Password Changed Successfully.');
    
            return redirect()->route('admin.change-password');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Could not change the password.'])->withInput();
        }
    }    
}