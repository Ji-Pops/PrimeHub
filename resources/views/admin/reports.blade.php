<!-- reports.blade.php -->

@extends('layouts.app')

@section('content')
    <!-- Summary Report -->
    <h2>Generate Report - Summary</h2>
    <form action="{{ route('generate-report') }}" method="POST">
        @csrf
        <label for="from_date">From:</label>
        <input type="date" id="from_date" name="from_date">
        <label for="to_date">To:</label>
        <input type="date" id="to_date" name="to_date">
        <button type="submit">Generate</button>
    </form>
    <p>Number of Completed Maintenance Requests: {{ $completedMaintenanceCount }}</p>
    
    <!-- Detailed Report -->
    <h2>Detailed Report</h2>
    <table>
        <thead>
            <tr>
                <th>Maintenance #</th>
                <th>Work Order #</th>
                <th>Department</th>
                <th>Date Created</th>
                <th>Date Completed</th>
                <th>Personnel</th>
                <th>Approved</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($detailedReportData as $data)
                <tr>
                    <td>{{ $data['maintenance_number'] }}</td>
                    <td>{{ $data['work_order_number'] }}</td>
                    <td>{{ $data['department'] }}</td>
                    <td>{{ $data['date_created'] }}</td>
                    <td>{{ $data['date_completed'] }}</td>
                    <td>{{ $data['personnel'] }}</td>
                    <td>{{ $data['approved_by'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
