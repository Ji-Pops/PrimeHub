<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Maintenance;
use App\Models\WorkOrder;

class DashboardController extends Controller
{
    public function index()
    {
        $userType = auth()->user()->user_type;

        if ($userType === 'admin') {
            // Check if the authenticated user is an admin
            if ($userType !== 'admin') {
                abort(403); // Return a 403 Forbidden error if the user is not an admin
            }

            // Logic for admin dashboard
            $total_tenants = Contact::where('user_type', 'tenant')->count();
            $total_requests = Maintenance::count();
            $open_requests = Maintenance::where('status', 'open')->count();
            $inprogress_requests = Maintenance::where('status', 'in-progress')->count();
            $completed_requests = Maintenance::where('status', 'completed')->count();
            $pending_requests = Maintenance::where('status', 'pending')->count();
            $closed_requests = Maintenance::where('status', 'closed')->count();
            $open_work_orders = WorkOrder::where('status', 'in-progress')->count();

            return view('admin.dashboard', [
                'total_tenants' => $total_tenants,
                'total_requests' => $total_requests,
                'open_requests' => $open_requests,
                'pending_requests' => $pending_requests,
                'inprogress_requests' => $inprogress_requests,
                'completed_requests' => $completed_requests,
                'closed_requests' => $closed_requests,
                'open_work_orders' => $open_work_orders,
            ]);
        } elseif ($userType === 'tenant') {
            // Logic for tenant dashboard
            return view('tenant.dashboard');
        } elseif ($userType === 'personnel') {
            // Logic for personnel dashboard
            return view('personnel.dashboard');
        }
         else {
            // Default dashboard for other user types
            return view('dashboard');
        }
    }
}
