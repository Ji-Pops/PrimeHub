<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Unit;
use App\Models\Maintenance;
use App\Models\Notification;
use App\Models\WorkOrder;

use Illuminate\Support\Facades\Auth;


class TenantMaintenanceController extends Controller
{
    public function dashboard()
    {
        // Code for the tenant dashboard
        return view('tenant.dashboard');
    }

    public function request()
    {
        $user = auth()->user();
        $contact = Contact::where('id', $user->contact_id)->first();
        $units = Unit::where('contacts_tenant_id', $contact->id)->get();

        $options = '';
        $firstUnit = null;
        foreach ($units as $unit) {
            $options .= '<a class="dropdown-item" href="#" data-unit="' . $unit->unit_number . '" data-name="' . $unit->unit_name . '">' . $unit->unit_number . ' - ' . $unit->unit_name . '</a>';
            if (!$firstUnit) {
                $firstUnit = $unit;
            }
        }
        return view('tenant.request-maintenance', compact('options', 'firstUnit'));

    }

    public function requestProcess(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'category' => 'required',
            'description' => 'required',
            'photo' => 'image|max:2048', // Assuming the photo is optional and has a maximum size of 2MB
        ]);

        // Create a new maintenance request
        $maintenance = new Maintenance();
        $maintenance->user_id = auth()->user()->id; // Retrieve the authenticated user's ID from the session
        $maintenance->unit_number = $request->input('unit_number');
        $maintenance->unit_name = $request->input('unit_name');
        $maintenance->category = $request->input('category');
        $maintenance->description = $request->input('description');
        $maintenance->status = 'Open';

        // Generate maintenance number
        $maxMaintenanceId = Maintenance::max('id');
        $newMaintenanceId = $maxMaintenanceId + 1;
        $maintenanceNumber = 'PHTMN' . str_pad($newMaintenanceId, 3, '0', STR_PAD_LEFT);
        $maintenance->maintenance_number = $maintenanceNumber;

        // Upload and save the photo if provided
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photoName = $photo->getClientOriginalName(); // Get the original file name

            // Move the uploaded file to the desired storage location
            $photoPath = $photo->storeAs('maintenance_request_photo', $photoName, 'public');

            // Save the photo path and name to the maintenance model
            $maintenance->maintenance_photo_path = $photoPath;
            $maintenance->photo = $photoName;
        }


        // Save the maintenance request
        $maintenance->save();

        // Create notification for admin
        $adminNotification = new Notification();
        $adminNotification->user_id = auth()->user()->id; // Assuming you are using the authenticated user's ID
        $adminNotification->maintenance_id = $maintenance->id;
        $adminNotification->message = $maintenance->unit_name . ' has a new maintenance request';
        $adminNotification->is_read = 0;
        $adminNotification->created_at = now();
        $adminNotification->notification_for = 'admin';

        // Create notification for tenant
        $tenantNotification = new Notification();
        $tenantNotification->user_id = auth()->user()->id; // Assuming you are using the authenticated user's ID
        $tenantNotification->maintenance_id = $maintenance->id;
        $tenantNotification->message = 'Your maintenance request has been submitted';
        $tenantNotification->is_read = 0;
        $tenantNotification->created_at = now();
        $tenantNotification->notification_for = 'tenant';
        try {
            $adminNotification->save();
            $tenantNotification->save();

            session()->flash('success', true);
            session()->flash('request_success_message', 'Maintenance Request Sent.');

            return redirect()->route('tenant.view-maintenance');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Could not send a request.'])->withInput();
        }
        
    }

    public function view()
    {
        // Retrieve the maintenance requests for the logged-in tenant
        $user_id = auth()->user()->id;
        $maintenanceRequests = Maintenance::where('user_id', $user_id)
            ->orderBy('updated_at', 'DESC')
            ->get();
    
        return view('tenant.view-maintenance', ['maintenanceRequests' => $maintenanceRequests]);
    }
    public function track($id)
    {
        // Retrieve the maintenance request by ID
        $maintenance = Maintenance::findOrFail($id);

        $workOrder = WorkOrder::where('maintenance_id', $maintenance->id)->first();

        $personnel = $workOrder->personnel;

        // Pass the maintenance request to the view
        return view('tenant.track-maintenance', compact('maintenance', 'personnel'));
    }

    public function feedback(Request $request, $id)
    {
        $maintenance = Maintenance::find($id);

         // Retrieve the maintenance requests for the logged-in tenant
         $user_id = auth()->user()->id;
         $maintenanceRequests = Maintenance::where('user_id', $user_id)
             ->orderBy('updated_at', 'DESC')
             ->get();
             
        $feedback = $request->input('feedback');

        $maintenance->feedback = $feedback;
        $maintenance->save();

        return view('tenant.view-maintenance', ['maintenanceRequests' => $maintenanceRequests]);
    }  
}
