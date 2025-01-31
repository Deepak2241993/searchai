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
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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
                                        @if ($Token->status == 'active')
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-info me-2 open-modal-btn"
                                                data-bs-toggle="modal"
                                                data-bs-target="#aadhaarOtpModal"
                                                data-id="{{ $Token->id }}"
                                                data-token="{{ $Token->token }}"
                                                data-service="{{ $Token->service_type }}">
                                                Generate OTP
                                            </button>
                                        </td>
                                        @else
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-primary view-data-btn"
                                                data-bs-toggle="modal"
                                                data-bs-target="#aadhaarDataModal"
                                                data-id="{{ $Token->id }}"
                                                data-token="{{ $Token->token }}"
                                                data-service="{{ $Token->service_type }}"
                                                data-aadhaar="{{ json_encode($Token->aadhaarData) }}">
                                                View
                                            </button>
                                            <a href="{{ route('download.pdf', $Token->id) }}" class="btn btn-sm btn-secondary">
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
               

                <form  id="aadhaarOtpForm" action="{{ route('aadhaar.generate') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" value="Aditya Kapoor" required>
                            </div>
                            <div class="mb-3">
                                <label for="father_name" class="form-label">Father's Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="father_name" value="Raj Kapoor" required>
                            </div>
                            <div class="mb-3">
                                <label for="date_of_birth" class="form-label">Date of Birth<span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="date_of_birth" value="1999-03-12" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="address" class="form-label">Address<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="address" value="A-123, Block-A, Sector-45, Gurgaon" required>
                            </div>
                            <div class="mb-3">
                                <label for="additional_address" class="form-label">Additional Address</label>
                                <input type="text" class="form-control" id="additional_address" value="F-123, Block-F, Vasant kunj, New Delhi">
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="consent" checked>
                                <label class="form-check-label" for="consent">Consent Given</label>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>

                <!-- Verify OTP Form (hidden initially) -->
                <div id="verifyOtpForm" class="d-none">
                    <h3>Verify OTP</h3>
                    <form id="verifyOtpSubmitForm" action="{{ route('aadhaar.submit') }}" method="POST">
                        @csrf
                        <input type="hidden" name="transaction_id" id="transaction_id" value="">

                        <label for="otp">OTP:</label>
                        <input type="text" name="otp" id="otp" required>

                        <label for="share_code">Share Code:</label>
                        <input type="text" name="share_code" id="verify_share_code" value="" maxlength="4" required>

                        <button type="submit">Verify OTP</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="aadhaarDataModal" tabindex="-1" aria-labelledby="aadhaarDataModalLabel" aria-hidden="true">
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
    $(document).ready(function() {
        // Submit Aadhaar OTP Generation form via AJAX
        $('#aadhaarOtpForm').on('submit', function(e) {
            e.preventDefault();

            var form = $(this);
            var formData = form.serialize();

            $.ajax({
                url: form.attr('action'),
                type: 'POST',
                data: formData,
                success: function(response) {
                    if (response.success) {
                        $('#transaction_id').val(response.transaction_id);
                        $('#verify_share_code').val(response.share_code);
                        $('#aadhaarOtpForm').addClass('d-none');
                        $('#verifyOtpForm').removeClass('d-none');
                    } else {
                        alert('OTP generation failed: ' + response.message);
                    }
                },
                error: function(xhr, status, error) {
                    alert('An error occurred while generating OTP: ' + error);
                }
            });
        });

        // Submit Verify OTP form via AJAX
        $('#verifyOtpSubmitForm').on('submit', function(e) {
            e.preventDefault();

            var form = $(this);
            var formData = form.serialize();
            $.ajax({
                url: form.attr('action'),
                type: 'POST',
                data: formData,
                success: function(response) {
                    if (response.success) {
                        alert('OTP verification successful!');
                        // Redirect or show success message
                        window.location.href = response.redirect_url;
                    } else {
                        alert('OTP verification failed: ' + response.message);
                    }
                },
                error: function(xhr, status, error) {
                    alert('An error occurred while verifying OTP: ' + error);
                }
            });
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.view-data-btn').forEach(button => {
            button.addEventListener('click', function() {
                const aadhaarData = JSON.parse(this.getAttribute('data-aadhaar'));
                document.getElementById('aadhaarNumber').textContent = aadhaarData.aadhaar_number || 'N/A';
                document.getElementById('aadhaarName').textContent = aadhaarData.name || 'N/A';
                document.getElementById('aadhaarDob').textContent = aadhaarData.date_of_birth || 'N/A';                    
                document.getElementById('aadhaarGender').textContent = aadhaarData.gender || 'N/A';
                document.getElementById('aadhaarCareof').textContent = aadhaarData.care_of || 'N/A';
                const addressParts = [

                    aadhaarData.house,
                    aadhaarData.street,
                    aadhaarData.district,
                    aadhaarData.sub_district,
                    aadhaarData.landmark,
                    aadhaarData.post_office_name,
                    aadhaarData.state,
                    aadhaarData.pincode
                ];
                const fullAddress = addressParts.filter(part => part).join(', ');
                document.getElementById('aadhaarAddress').textContent = fullAddress || 'N/A';
            });
        });
    });
</script>
@endsection