<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class AdminContactsController extends Controller
{
    public function dashboard()
    {
        // Code for the admin dashboard
        return view('admin.dashboard');
    }   

 ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    //Admin Contacts Page
    //Display Admin Contacts
    public function admin()
    {
        // Code for the admin page
        return view('admin.admin');
    }

    //Form Add Admin
    public function add_Admin()
    {
        // Code for the admin page
        return view('admin.add-admin');
    }

    //Add Admin Function
    public function addAdmin(Request $request)
    {
        // Check if the required fields are set and not empty
        if ($request->filled(['first_name', 'last_name', 'email', 'phone'])) {
            // Get the form input data
            $first_name = $request->input('first_name');
            $last_name = $request->input('last_name');
            $email = $request->input('email');
            $phone = $request->input('phone');

            // Get profile picture
            if ($request->hasFile('profile_picture')) {
                $profile_picture = $request->file('profile_picture');
                $profile_picture_path = $profile_picture->store('profiles/admin', 'public');
            } else {
                // Set default profile picture if not uploaded
                $profile_picture_path = 'default_profile_picture.jpg';
            }

            // Prepare and execute the insert statement
            $user_type = 'admin';

            try {
                DB::table('contacts')->insert([
                    'user_type' => $user_type,
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'email' => $email,
                    'phone' => $phone,
                    'profile_picture' => $profile_picture->getClientOriginalName(),
                    'profile_picture_path' => $profile_picture_path,
                ]);

                session()->flash('success', true);
                session()->flash('added_success_message', 'Admin Added Successfully.');

                return redirect()->route('admin.admin');
            } catch (\Exception $e) {
                return back()->withErrors(['error' => 'Could not execute the insert statement.'])->withInput();
            }
        } else {
            return back()->withErrors(['error' => 'Required fields are missing.'])->withInput();
        }
    }

    //Form Update Admin
    public function update_Admin($id)
    {
        // Retrieve the admin record based on the provided ID
        $admin = Contact::find($id);
        
        if (!$admin) {
            // Handle case when admin is not found
            return back()->withErrors(['error' => 'Admin not found.']);
        }
    
        // Pass the admin data to the view
        return view('admin.update-admin', compact('admin'));
    }
    
    //Update Admin Function
    public function updateAdmin(Request $request)
    {
        // Check if the required fields are set and not empty
        if ($request->filled(['first_name', 'last_name', 'email', 'phone'])) {
            // Get the form input data
            $first_name = $request->input('first_name');
            $last_name = $request->input('last_name');
            $email = $request->input('email');
            $phone = $request->input('phone');

            // Retrieve the admin record based on the provided ID
            $admin = Contact::find($request->id);

            if (!$admin) {
                return back()->withErrors(['error' => 'Admin not found.'])->withInput();
            }

            // Update the admin attributes
            $admin->first_name = $first_name;
            $admin->last_name = $last_name;
            $admin->email = $email;
            $admin->phone = $phone;

            try {
                $admin->save();

                session()->flash('success', true);
                session()->flash('updated_success_message', 'Admin Updated Successfully.');

                return redirect()->route('admin.admin');
            } catch (\Exception $e) {
                return back()->withErrors(['error' => 'Could not update the admin.'])->withInput();
            }
        } else {
            return back()->withErrors(['error' => 'Required fields are missing.'])->withInput();
        }
    }

    // Delete Admin Function
    public function delete_Admin($id)
    {
        // Retrieve the admin record based on the provided ID
        $admin = Contact::find($id);
         
        if (!$admin) {
            return back()->withErrors(['error' => 'Admin not found.']);
        }
    
        try {
            $admin->delete();

            session()->flash('success', true);
            session()->flash('deleted_success_message', 'Admin Deleted Successfully.');
    
            return redirect()->route('admin.admin');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Could not delete the admin.']);
        }
    }    
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    //Tenant Contacts Page
    //Display Tenant Contacts
    public function tenants()
    {
        $tenants = Contact::where('user_type', 'tenant')->paginate(8);
        return view('admin.tenants', compact('tenants'));
    }

  //Form Add Tenant
  public function add_Tenant()
  {
      // Code for the admin page
      return view('admin.add-tenant');
  }

    //Add Tenant Function
    public function addTenant(Request $request)
    {
        // Check if the required fields are set and not empty
        if ($request->filled(['first_name', 'last_name', 'email', 'phone'])) {
            // Get the form input data
            $first_name = $request->input('first_name');
            $last_name = $request->input('last_name');
            $email = $request->input('email');
            $phone = $request->input('phone');

            // Get profile picture
            if ($request->hasFile('profile_picture')) {
                $profile_picture = $request->file('profile_picture');
                $profile_picture_path = $profile_picture->store('profiles/tenant', 'public');
            } else {
                // Set default profile picture if not uploaded
                $profile_picture_path = 'default_profile_picture.jpg';
            }

            // Prepare and execute the insert statement
            $user_type = 'tenant';

            try {
                DB::table('contacts')->insert([
                    'user_type' => $user_type,
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'email' => $email,
                    'phone' => $phone,
                    'profile_picture' => $profile_picture->getClientOriginalName(),
                    'profile_picture_path' => $profile_picture_path,
                ]);

                session()->flash('success', true);
                session()->flash('added_success_message', 'Tenant Added Successfully.');

                return redirect()->route('admin.tenant');
            } catch (\Exception $e) {
                return back()->withErrors(['error' => 'Could not execute the insert statement.'])->withInput();
            }
        } else {
            return back()->withErrors(['error' => 'Required fields are missing.'])->withInput();
        }
    }

    //Form Update Tenant
    public function update_Tenant($id)
    {
        // Retrieve the tenant record based on the provided ID
        $tenant= Contact::find($id);
        
        if (!$tenant) {
            // Handle case when tenant is not found
            return back()->withErrors(['error' => 'Tenant not found.']);
        }
    
        // Pass the tenant data to the view
        return view('admin.update-tenant', compact('tenant'));
    }

    //Update Tenant Function
    public function updateTenant(Request $request)
    {
        // Check if the required fields are set and not empty
        if ($request->filled(['first_name', 'last_name', 'email', 'phone'])) {
            // Get the form input data
            $first_name = $request->input('first_name');
            $last_name = $request->input('last_name');
            $email = $request->input('email');
            $phone = $request->input('phone');

            // Retrieve the tenant record based on the provided ID
            $tenant = Contact::find($request->id);

            if (!$tenant) {
                return back()->withErrors(['error' => 'Tenant not found.'])->withInput();
            }

            // Update the tenant attributes
            $tenant->first_name = $first_name;
            $tenant->last_name = $last_name;
            $tenant->email = $email;
            $tenant->phone = $phone;

            try {
                $tenant->save();

                session()->flash('success', true);
                session()->flash('updated_success_message', 'Tenant Updated Successfully.');

                return redirect()->route('admin.tenant');
            } catch (\Exception $e) {
                return back()->withErrors(['error' => 'Could not update the tenant.'])->withInput();
            }
        } else {
            return back()->withErrors(['error' => 'Required fields are missing.'])->withInput();
        }
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    //User Registration

    public function admin_Registration($id)
    {
        $admin = Contact::find($id);

        if (!$admin) {
            // Handle case when admin is not found
            return back()->withErrors(['error' => 'Admin not found.']);
        }
    
        // Code for the admin page
        return view('admin.admin-registration', compact('admin'));
    }

    public function registerAdmin(Request $request)
    {
        $admin = Contact::find($request->input('contact_id'));

        if (!$admin) {
            return back()->withErrors(['error' => 'Admin not found.']);
        }

        if ($request->filled(['username', 'contact_id', 'password'])) {
            $username = $request->input('username');
            $contact_id = $request->input('contact_id');
            $password = bcrypt($request->input('password'));

            try {
                DB::table('users')->insert([
                    'username' => $username,
                    'password' => $password,
                    'user_type' => 'admin',
                    'contact_id' => $contact_id,
                ]);

                session()->flash('success', true);
                session()->flash('added_success_message', 'Registered User Successfully.');

                return redirect()->route('admin.admin');
            } catch (\Exception $e) {
                return back()->withErrors(['error' => 'Could not execute the insert statement.'])->withInput();
            }
        } else {
            return back()->withErrors(['error' => 'Required fields are missing.'])->withInput();
        }
    }

    public function searchTenant(Request $request)
    {
        $searchTerm = $request->input('search');
        $tenants = Contact::where('user_type', 'tenant')
            ->where(function ($query) use ($searchTerm) {
                $query->where('first_name', 'like', '%'.$searchTerm.'%')
                    ->orWhere('last_name', 'like', '%'.$searchTerm.'%');
            })
            ->paginate(8);

        $message = $tenants->isEmpty() ? "No result for '$searchTerm'" : null;

        return view('admin.search-tenants', compact('tenants', 'message'));
    }

    public function deleteAdmin($id)
    {
        // Find the admin contact by its ID
        $adminContact = Contact::find($id);
    
        if (!$adminContact) {
            // Admin contact not found, handle the error
            return redirect()->route('admin.admin')->with('error_message', 'Admin contact not found');
        }
    
        // Find the user associated with the admin contact
        $user = User::where('contact_id', $adminContact->id)->first();
    
        if ($user) {
            // Delete the user
            $user->delete();
        }
    
        // Perform the deletion of the admin contact
        $adminContact->delete();
    
        // Redirect back to the admin page with success message
        return redirect()->route('admin.admin')->with('deleted_success_message', 'Admin deleted successfully');
    }    
}