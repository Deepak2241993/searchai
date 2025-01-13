@extends('layouts.admin-master')

@section('title')
Token List
@endsection

@section('content')
<div class="app-content-header bg-light py-3 shadow-sm">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <h3 class="mb-0">Token List</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end mb-0">
                    <li class="breadcrumb-item"><a href="#" class="text-decoration-none">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Token List</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="app-content py-4">
    <div class="container-fluid">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body d-flex justify-content-between align-items-center rounded">
                <h4 class="card-title mb-0">Token Management</h4>
            </div>
        </div>

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
                                        <td>{{ $Token->service_type ? 'KYC VERIFICATION' : 'KYC VERIFICATION' }}</td>
                                        <td>{{ $Token->token }}</td>
                                        <td>{{ $Token->status == 'active' ? 'Active' : 'Expired' }}</td>
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
                <h5 class="modal-title" id="aadhaarOtpModalLabel">Generate OTP</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Aadhaar OTP Generation Form -->
                <form id="aadhaarOtpForm" action="{{ route('aadhaar.generate') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="aadhaar_number" class="form-label">Aadhaar Number:</label>
                        <input type="text" name="aadhaar_number" id="aadhaar_number" class="form-control" required>
                    </div>

                    <!-- Share Code (4 characters) -->
                    <div class="mb-3">
                        <label for="share_code" class="form-label">Share Code (4 characters):</label>
                        <input type="text" name="share_code" id="share_code" maxlength="4" class="form-control" required>
                    </div>

                    <!-- Hidden fields for Token and Service Type -->
                    <input type="hidden" name="token" id="modalToken" value="">
                    <input type="hidden" name="service_type" id="modalServiceType" value="">

                    <!-- Display Token Info -->
                    <div class="mb-3">
                        <p><strong>Service Type:</strong> <span id="modalServiceTypeDisplay"></span></p>
                        <p><strong>Token:</strong> <span id="modalTokenDisplay"></span></p>
                    </div>

                    <button type="submit" class="btn btn-primary">Generate OTP</button>
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
                document.getElementById('modalServiceType').value = serviceType;
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
                    // Assume response contains the share code and transaction ID
                    if(response.success) {
                        // Store the transaction ID and share code in session or directly
                        $('#transaction_id').val(response.transaction_id);
                        $('#verify_share_code').val(response.share_code);
                        
                        // Hide the OTP generation form and show the verify OTP form
                        $('#aadhaarOtpForm').addClass('d-none');
                        $('#verifyOtpForm').removeClass('d-none');
                    } else {
                        // Handle failure response
                        alert('OTP generation failed: ' + response.message);
                    }
                },
                error: function(xhr, status, error) {
                    // Handle error
                    alert('An error occurred while generating OTP: ' + error);
                }
            });
        });

        // Submit Verify OTP form via AJAX
        $('#verifyOtpSubmitForm').on('submit', function(e) {
            e.preventDefault();
            
            var form = $(this);
            var formData = form.serialize(); // Get form data
            
            $.ajax({
                url: form.attr('action'), // The action URL
                type: 'POST',
                data: formData,
                success: function(response) {
                    if(response.success) {
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
@endsection
