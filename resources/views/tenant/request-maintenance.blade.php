@extends('layouts.appTenant')

@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Maintenance Request</h1>
<form action="{{ route('tenant.requestProcess') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="d-inline-block">
        <div class="small mb-1"></div>
        <div class="input-group">
            <div class="dropdown mb-4">
                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Unit
                </button>
                <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
                    {!! $options !!}
                </div>
            </div>
            <input type="text" class="form-control" id="selected_unit_number" name="unit_number" placeholder="Unit Number" value="{{ $firstUnit->unit_number }}" readonly>
            <input type="text" class="form-control" id="selected_unit_name" name="unit_name" placeholder="Unit Name" value="{{ $firstUnit->unit_name }}" readonly>
        </div>
    </div>

    <div class="form-group">
        <label for="categoryIssue">Category Issue:</label>
        <select class="form-control" id="categoryIssue" name="category" required>
            <option disabled selected value="">-----------------</option>
            <option value="Electrical">Electrical</option>
            <option value="Plumbing">Plumbing</option>
            <option value="Airconditioning">Airconditioning</option>
            <option value="Structural">Structural</option>
        </select>
    </div>

    <div class="form-group">
        <label for="problemDescription">Problem Description:</label>
        <textarea class="form-control" id="problemDescription" name="description" rows="5" required></textarea>
    </div>

    <div class="form-group">
        <label for="photo">Photo:</label>
        <input type="file" class="form-control" id="photo" name="photo" accept=".jpg, .jpeg, .png" 
            onchange="validatePhoto(this)" required>
        <small class="text-muted">Please note that only JPG (.jpg/.jpeg), PNG (.png), and GIF (.gif) formats are accepted. Maximum file size: 5MB.</small>
        <div class="invalid-feedback">
            Please choose a photo in JPG, JPEG, or PNG format, with a maximum file size of 5MB.
        </div>
</div>

    <input type="hidden" name="created_at" value="{{ date('Y-m-d H:i:s') }}">
    <input type="hidden" name="updated_at" value="">

    <button type="submit" class="btn btn-primary">Submit</button>
</form>

<script>
  const dropdownItems = document.querySelectorAll('.dropdown-item');
  const selectedUnitNumber = document.getElementById('selected_unit_number');
  const selectedUnitName = document.getElementById('selected_unit_name');

  // Loop through each dropdown item and add a click event listener
  dropdownItems.forEach((item) => {
    item.addEventListener('click', () => {
      // Set the selected unit number and name in the input fields
      selectedUnitNumber.value = item.getAttribute('data-unit');
      selectedUnitName.value = item.getAttribute('data-name');
    });
  });
</script>
@endsection
