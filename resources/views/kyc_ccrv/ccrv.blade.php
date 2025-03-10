@extends('layouts.admin-master')

@section('title')
    CCRV
@endsection

@section('content')
    <div class="app-content-header bg-light py-3 shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h3 class="mb-0">CCRV</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end mb-0">
                        <li class="breadcrumb-item"><a href="#" class="text-decoration-none">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">CCRV</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content py-4">
        <div class="container-fluid">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body d-flex justify-content-between align-items-center rounded">
                    <h4 class="card-title mb-0">CCRV Token</h4>
                </div>
            </div>
            <!-- Show success message -->
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Show error messages -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="row">
                <div class="col-md-12">
                    <div class="card border-0 shadow-sm">
                        @if (session('message'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="bi bi-check-circle-fill me-2"></i> {{ session('message') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatable-buttons" class="table table-hover table-striped align-middle mb-0">
                                    <thead class="bg-primary text-white">
                                        <tr>
                                            <th>#</th>
                                            <th>Service Type</th>
                                            <th>Token</th>
                                            <th>Status</th>
                                            <th>Generated Date</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($data as $key => $Token)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $Token->service_type }}</td>
                                                <td>{{ $Token->token }}</td>
                                                <td>{{ $Token->status == 'active' ? 'Active' : 'Expired' }}</td>
                                                <td>{{ date('d-m-Y',strtotime($Token->created_at)) }}</td>
                                                @if ($Token->status == 'active')
                                                    <td class="text-center">
                                                        <button class="btn btn-sm btn-info me-2 open-modal-btn"
                                                            data-bs-toggle="modal" data-bs-target="#aadhaarOtpModal"
                                                            data-id="{{ $Token->id }}" data-token="{{ $Token->token }}"
                                                            data-service="{{ $Token->service_type }}">
                                                            Generate Report
                                                        </button>
                                                    </td>
                                                @else
                                                    <td class="text-center">
                                                        <button class="btn btn-sm btn-primary view-data-btn"
                                                            data-bs-toggle="modal" data-bs-target="#aadhaarDataModal"
                                                            data-id="{{ $Token->id }}" data-token="{{ $Token->token }}"
                                                            data-service="{{ $Token->service_type }}"
                                                            data-aadhaar="{{ json_encode($Token->aadhaarData) }}">
                                                            View
                                                        </button>
                                                        <a href="{{ route('download.pdf', $Token->id) }}"
                                                            class="btn btn-sm btn-secondary">
                                                            Download PDF
                                                        </a>
                                                    </td>
                                                @endif
                                               
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center text-muted">No data found.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>

                                </table>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-end">
                            <nav>
                                {{ $data->links('pagination::bootstrap-4') }}
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Aadhaar OTP Generation -->
    <div class="modal fade" id="aadhaarOtpModal" tabindex="-1" aria-labelledby="aadhaarOtpModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="aadhaarOtpModalLabel">Generate CCRV Report</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Aadhaar OTP Generation Form -->


                    <form id="aadhaarOtpForm" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="name" name="name" value="" required>
                                </div>
                                <div class="mb-3">
                                    <label for="father_name" class="form-label">Father's Name<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="father_name" name="father_name" value="" required>
                                </div>
                                <div class="mb-3">
                                    <label for="date_of_birth" class="form-label">Date of Birth<span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="" placeholder="YYYY-MM-DD" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="address" class="form-label">Address<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="address" name="address" value="" required>
                                </div>
                                <div class="mb-3">
                                    <label for="additional_address" class="form-label">Additional Address</label>
                                    <input type="text" class="form-control" id="additional_address" name="additional_address" value="">
                                </div>
                                <div class="mb-3 form-check">
                                    <input type="hidden" class="form-check-input" value="Y" id="consent" name="consent" checked>
                                    {{-- <label class="form-check-label" for="consent">Consent Given</label> --}}
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="token" id="modalToken" value="">
                        <input type="hidden" name="service_type" id="modalServiceType" value="CCRV">
                        <button type="submit" class="btn btn-primary" id="submitButton">Submit</button>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="aadhaarDataModal" tabindex="-1" aria-labelledby="aadhaarDataModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="aadhaarDataModalLabel">Aadhaar Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>Aadhaar Number</th>
                                <td id="aadhaarNumber"></td>
                            </tr>
                            <tr>
                                <th>Name</th>
                                <td id="aadhaarName"></td>
                            </tr>
                            <tr>
                                <th>Date of Birth</th>
                                <td id="aadhaarDob"></td>
                            </tr>
                            <tr>
                                <th>Gender</th>
                                <td id="aadhaarGender"></td>
                            </tr>
                            <tr>
                                <th>Care of</th>
                                <td id="aadhaarCareof"></td>
                            </tr>
                            <tr>
                                <th>Address</th>
                                <td id="aadhaarAddress"></td>
                            </tr>
                            <!-- Add more fields as needed -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handle modal opening
            document.querySelectorAll('.open-modal-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const serviceType = this.getAttribute('data-service');
                    const token = this.getAttribute('data-token');
                    // Set modal values
                    // document.getElementById('modalServiceType').value = serviceType;
                    document.getElementById('modalToken').value = token;
                    document.getElementById('modalServiceTypeDisplay').textContent = serviceType;
                    document.getElementById('modalTokenDisplay').textContent = token;
                });
            });
        });
    </script>
    <script>
        
        $('#aadhaarOtpForm').on('submit', function(e) {
            e.preventDefault();  // Prevent form from submitting the usual way

            // Validate form fields
            if (!$('#name').val() || !$('#father_name').val() || !$('#date_of_birth').val() || !$('#address').val()) {
                alert('Please fill in all required fields.');
                return;  // Stop the form submission if validation fails
            }

            // Show the spinner on button click
            var submitButton = $('#submitButton');
            submitButton.prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...'); // Show spinner and disable button

            var form = $(this);
            var formData = form.serialize();  // Serialize the form data

            $.ajax({
                url: '{{ route('ccrv-report') }}',
                type: 'POST',
                data: formData,  // Send serialized data
                success: function(response) {
            console.log(response);
            
            if (response.success) {
                alert(response.message);
                
                if (response.redirect_url) {
                    window.location.href = response.redirect_url;  // Redirect upon success
                }
            } else {
                alert('Operation failed: ' + response.message);
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', error);
            alert('Technical Error Try After Some Time');
        },
        complete: function() {
            // Hide spinner and enable button after AJAX call
            submitButton.prop('disabled', false).html('Submit');
        }
            });
        });

    </script>

    
@endsection
