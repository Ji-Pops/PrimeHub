<?php

namespace App\Http\Controllers;

use App\Models\Maintenance;
use App\Models\Personnel;
use App\Models\Contact;
use Illuminate\Support\Facades\DB;
Use App\Models\WorkOrder;
use Carbon\Carbon;

use Illuminate\Http\Request;

class AdminMaintenanceController extends Controller
{
    //Admin Maintenance Task Page
    //Display Maintenance Task
    public function maintenanceTask(Request $request)
    {
        // Get the selected status value from the request
        $status = $request->input('status');

        // Fetch the maintenance records based on the selected status
        $maintenances = ($status) ? Maintenance::where('status', $status)->orderBy('updated_at', 'desc')->get() : Maintenance::orderBy('updated_at', 'desc')->get();

        // Pass the fetched data and the selected status to the view
        return view('admin.maintenance-task', [
            'maintenances' => $maintenances,
            'status' => $status,
        ]);
    }

    public function maintenanceView($id)
    {
        $maintenance = Maintenance::find($id);
        
        // Fetch the work order associated with the maintenance
        $workOrder = WorkOrder::where('maintenance_id', $maintenance->id)->first();
        
        // Retrieve the personnel information from the work order (assuming there is a 'personnel' field in the WorkOrder model)
        $personnel = $workOrder->personnel ?? null;
    
        return view('admin.maintenance-view', compact('maintenance', 'personnel'));
    }
    

    public function maintenanceAssignment($id)
    {
        // Fetch data from maintenance table
        $maintenance = Maintenance::find($id);

        // Fetch tenant's name from contacts table
        $tenant = Contact::join('users', 'contacts.id', '=', 'users.contact_id')
            ->where('users.id', $maintenance->user_id)
            ->select('contacts.first_name', 'contacts.last_name')
            ->first();

        $tenant_name = $tenant->first_name . ' ' . $tenant->last_name;

        // Retrieve personnel data
        $personnel = Personnel::all();

        return view('admin.maintenance-assignment', compact('maintenance', 'tenant_name', 'personnel'));
    }

    public function maintenanceAssignmentProcess(Request $request)
    {
        // Fetch data from maintenance table
        $maintenance = Maintenance::find($request->id);
        $personnel_id = $request->input('maintenance_personnel');
        $personnel = Personnel::find($personnel_id);

        // Check if the required fields are set and not empty
        if ($request->filled(['notes'])) {
            // Get the form input data
            $notes = $request->input('notes');

            // Prepare data for creating a new WorkOrder record
            $data = [
                'unit_number' => $request->input('unit_number'),
                'unit_name' => $request->input('unit_name'),
                'request_date_created' => $request->input('request_date_created'),
                'tenant_name' => $request->input('tenant_name'),
                'description' => $request->input('description'),
                'category' => $request->input('category'),
                'work_order_number' => 'WO-' . $maintenance->maintenance_number,
                'maintenance_id' => $maintenance->id,
                'department' => $personnel->department,
                'status' => 'Pending',
                'notes' => $notes,
                'personnel' => $personnel->first_name . ' ' . $personnel->last_name,
                'approved_by_full_name' => $request->input('approved_by'),
                'created_at' => now(),
                'updated_at' => now(),
            ];

            // Insert a new WorkOrder record
            $workOrder = WorkOrder::create($data);

            // Update the maintenance record
            $maintenance->status = 'Pending';
            $maintenance->updated_at = now();
            $maintenance->save();

            session()->flash('success', true);
            session()->flash('assignment_success_message', 'Maintenance Task Assigned Successfully.');

            return redirect()->route('admin.maintenance-view', ['id' => $request->id]);
        } else {
            return back()->withErrors(['error' => 'Required fields are missing.'])->withInput();
        }
    }

    public function closeRequest(Request $request, $maintenance)
    {
        // Find the maintenance request by its ID
        $maintenanceRequest = Maintenance::find($maintenance);
        
        // Update the status of the maintenance request to "Closed"
        $maintenanceRequest->status = 'Closed';
        $maintenanceRequest->save();
        
        // Redirect back to the maintenance view page with success message
        return redirect()->route('admin.maintenance-view', ['id' => $maintenanceRequest->id])->with('updated_success_message', 'Maintenance task closed.');
    }    
}

