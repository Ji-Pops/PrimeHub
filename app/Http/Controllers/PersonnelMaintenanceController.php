<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Maintenance;
use App\Models\Contact;
use App\Models\WorkOrder;
use App\Models\Personnel;
use App\Models\Notification;



class PersonnelMaintenanceController extends Controller
{
    public function taskView()
    {
        return view('personnel/task-view');
    }
    
    public function taskMaintenance($id)
    {
    // Fetch data from work_order table
    $workOrder = WorkOrder::find($id);

    if (!$workOrder) {
        // Handle the case when the work order record is not found
        // For example, you can redirect the user or show an error message
        return redirect()->back()->with('error', 'Work Order not found');
    }
    
    // Retrieve the maintenance record based on the work_order_id
    $maintenance = Maintenance::find($workOrder->maintenance_id);
    
    if (!$maintenance) {
        // Handle the case when the maintenance record is not found
        // For example, you can redirect the user or show an error message
        return redirect()->back()->with('error', 'Maintenance record not found');
    }
    
    // Fetch tenant's name from contacts table
    $tenant = Contact::join('users', 'contacts.id', '=', 'users.contact_id')
        ->where('users.id', $maintenance->user_id)
        ->select('contacts.first_name', 'contacts.last_name')
        ->first();
    
    $tenant_name = $tenant->first_name . ' ' . $tenant->last_name;

    $assessment = ''; // Initialize the $assessment variable
    // Retrieve the assessment and category values if they exist in the work order
    if ($maintenance->workOrder) {
        $assessment = $maintenance->workOrder->assessment;
        $category = $maintenance->workOrder->category;
    }$category = ''; // Initialize the $category variable

    return view('personnel.assess-maintenance', compact('maintenance', 'tenant_name'));
    }

    public function acceptTask(Request $request, $id)
    {
        // Fetch the maintenance record based on the ID
        $maintenance = Maintenance::find($id);

        // Retrieve the work order associated with the maintenance record
        $workOrder = WorkOrder::where('maintenance_id', $maintenance->id)->first();
    
        // Retrieve the submitted data
        $assessment = $request->input('assessment');
        $category = $request->input('category');
        $categoryDetails = $request->input('category_details');
    
        // Set the category value based on the selection
        if ($category == 'Others') {
            $category = $categoryDetails;
        }
        
        $maintenance->assessment = $assessment;
        $maintenance->category = $category;
        // Update maintenance and work order data
        $maintenance->status = 'In-Progress';
        $maintenance->updated_at = now();
        $maintenance->save();
    
        $workOrder->status = 'In-Progress';
        $workOrder->updated_at = now();
        $workOrder->save();

        // Create notification for admin
        $adminNotification = new Notification();
        $adminNotification->user_id = $maintenance->user_id;
        $adminNotification->maintenance_id = $maintenance->id;
        $adminNotification->message = "Maintenance for '{$maintenance->unit_name}' is in-progress";
        $adminNotification->is_read = 0;
        $adminNotification->created_at = now();
        $adminNotification->updated_at = now();
        $adminNotification->notification_for = 'admin';
        $adminNotification->save();

        // Create notification for tenant
        $tenantNotification = new Notification();
        $tenantNotification->user_id = $maintenance->user_id;
        $tenantNotification->maintenance_id = $maintenance->id;
        $tenantNotification->message = "Your maintenance request for '{$maintenance->unit_name}' is in-progress";
        $tenantNotification->is_read = 0;
        $tenantNotification->created_at = now();
        $tenantNotification->updated_at = now();
        $tenantNotification->notification_for = 'tenant';
        $tenantNotification->save();

        return view('personnel.task-view');
    }    

    public function complete_Task($id)
    {
        // Fetch data from work_order table
    $workOrder = WorkOrder::find($id);

    if (!$workOrder) {
        // Handle the case when the work order record is not found
        // For example, you can redirect the user or show an error message
        return redirect()->back()->with('error', 'Work Order not found');
    }
    
    // Retrieve the maintenance record based on the work_order_id
    $maintenance = Maintenance::find($workOrder->maintenance_id);
    
    if (!$maintenance) {
        // Handle the case when the maintenance record is not found
        // For example, you can redirect the user or show an error message
        return redirect()->back()->with('error', 'Maintenance record not found');
    }
    
    // Fetch tenant's name from contacts table
    $tenant = Contact::join('users', 'contacts.id', '=', 'users.contact_id')
        ->where('users.id', $maintenance->user_id)
        ->select('contacts.first_name', 'contacts.last_name')
        ->first();
    
    $tenant_name = $tenant->first_name . ' ' . $tenant->last_name;

    $assessment = ''; // Initialize the $assessment variable
    // Retrieve the assessment and category values if they exist in the work order
    if ($maintenance->workOrder) {
        $assessment = $maintenance->workOrder->assessment;
        $category = $maintenance->workOrder->category;
    }$category = ''; // Initialize the $category variable

    return view('personnel.complete-maintenance', compact('maintenance', 'tenant_name'));
    }

    public function completeTask(Request $request, $id)
    {
        // Fetch the maintenance record based on the ID
        $maintenance = Maintenance::find($id);

        // Retrieve the work order associated with the maintenance record
        $workOrder = WorkOrder::where('maintenance_id', $maintenance->id)->first();

        // Update maintenance and work order data
        $maintenance->status = 'Completed';
        $maintenance->updated_at = now();
        $maintenance->save();
    
        $workOrder->status = 'Completed';
        $workOrder->updated_at = now();
        $workOrder->save();

        // Create notification for admin
        $adminNotification = new Notification();
        $adminNotification->user_id = $maintenance->user_id;
        $adminNotification->maintenance_id = $maintenance->id;
        $adminNotification->message = "Maintenance for '{$maintenance->unit_name}' is completed";
        $adminNotification->is_read = 0;
        $adminNotification->created_at = now();
        $adminNotification->updated_at = now();
        $adminNotification->notification_for = 'admin';
        $adminNotification->save();

        // Create notification for tenant
        $tenantNotification = new Notification();
        $tenantNotification->user_id = $maintenance->user_id;
        $tenantNotification->maintenance_id = $maintenance->id;
        $tenantNotification->message = "Your maintenance request for '{$maintenance->unit_name}' is completed";
        $tenantNotification->is_read = 0;
        $tenantNotification->created_at = now();
        $tenantNotification->updated_at = now();
        $tenantNotification->notification_for = 'tenant';
        $tenantNotification->save();

        return view('personnel.task-view');
    }
}
