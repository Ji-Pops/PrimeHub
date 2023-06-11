<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Maintenance;
use App\Models\WorkOrder;
use App\Models\Personnel;

class ReportsController extends Controller
{
    public function generateReport(Request $request)
    {
        // Get the input date range from the request
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');
        
        // Retrieve completed maintenance requests within the specified time frame
        $completedMaintenances = Maintenance::where('status', 'Completed')
            ->whereBetween('completed_at', [$fromDate, $toDate])
            ->get();
        
        // Count the number of completed maintenance requests
        $completedMaintenanceCount = $completedMaintenances->count();
        
        // Fetch relevant details for the detailed report
        $detailedReportData = [];
        foreach ($completedMaintenances as $maintenance) {
            $workOrder = WorkOrder::where('maintenance_id', $maintenance->id)->first();
            $personnel = Personnel::find($workOrder->personnel_id);
            
            $detailedReportData[] = [
                'maintenance_number' => $maintenance->maintenance_number,
                'work_order_number' => $workOrder->work_order_number,
                'department' => $workOrder->department,
                'date_created' => $maintenance->created_at,
                'date_completed' => $maintenance->completed_at,
                'personnel' => $personnel->first_name . ' ' . $personnel->last_name,
                'approved_by' => $workOrder->approved_by_full_name,
            ];
        }
        
        // Return the reports view with the data
        return view('reports', compact('completedMaintenanceCount', 'detailedReportData'));
    }
}
