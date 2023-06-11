@extends('layouts.app')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Maintenance Status</h1>

    <!-- Card -->
    <div class="card shadow mb-4">
        <!-- Card Header -->
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Maintenance Request</h6>
        </div>
        @if(session('assignment_success_message'))
            <div class="alert alert-success">
                {{ session('assignment_success_message') }}
            </div>
        @endif

        <!-- Card Body -->
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <img src="{{ asset('storage/' . $maintenance->maintenance_photo_path) }}" class="img-fluid" alt="Maintenance Photo">
                </div>
                <div class="col-md-6">
                    <h4 class="font-weight-bold">{{ $maintenance->unit_name }}</h4>
                    <p><strong>Category:</strong> {{ $maintenance->category }}</p>
                    <p><strong>Description:</strong></p>
                    <p>{{ $maintenance->description }}</p>
                    <p><strong>Created:</strong> {{ $maintenance->created_at }}</p>
                    <p><strong>Status:</strong> {{ $maintenance->status }}</p>
                    <p><strong>Updated:</strong> {{ $maintenance->updated_at }}</p>
                    
                    @if(!empty($personnel))
                        <p><strong>Personnel:</strong> {{ $personnel }}</p>
                    @endif
                    
                    @if(!empty($maintenance->remarks))
                        <p><strong>Remarks:</strong> {{ $maintenance->remarks }}</p>
                    @endif
                    
                    @if(!empty($maintenance->feedback))
                        <p><strong>Feedback:</strong> {{ $maintenance->feedback }}</p>
                    @endif
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-12">
                    <a href="{{ url('admin/maintenance-task') }}" class="btn btn-primary">Back</a>
                    
                    @if ($maintenance->status === 'Open')
                        <a href="{{ route('admin.maintenance-assignment', ['id' => $maintenance->id]) }}" class="btn btn-success">Assign Task</a>
                    @elseif ($maintenance->status === 'cancelled')
                        <a href="view_order.php?id={{ $maintenance->id }}" class="btn btn-success">Work Order</a>
                    @elseif ($maintenance->status === 'Completed' && $maintenance->acknowledge === 1)
                        <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#updateModal">Close Request</a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Update Modal -->
    <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">Are you sure you want to close the maintenance request?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('admin.closeRequest', ['maintenance' => $maintenance->id]) }}">
                        @csrf
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Confirm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Modal -->
@endsection

<script>
    setTimeout(function() {
        $('.alert-success').hide();
    }, 2000);
</script>
