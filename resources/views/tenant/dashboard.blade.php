@extends('layouts.appTenant')

@section('content')
<link href="{{ asset('css/dashboardStyle.css') }}" rel="stylesheet">
<div class="container">
    @if (auth()->user()->created_at == auth()->user()->updated_at)
        <div class="alert alert-warning">
            Please change your password before accessing the system.
        </div>
    @endif
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>
</div>
@endsection
