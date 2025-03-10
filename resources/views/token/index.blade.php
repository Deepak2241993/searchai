@extends('layouts.admin-master')

@section('title')
Token List
@endsection

@section('content')
<div class="app-content-header bg-light py-3 shadow-sm">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <h3 class="mb-0">Background Verification Token </h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end mb-0">
                    <li class="breadcrumb-item"><a href="#" class="text-decoration-none">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Background Verification List</li>
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
                                        <th>Purchase Date</th>
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
                                        <td>{{ (date('d-m-Y',strtotime($Token->created_at))) }}</td>
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
                    <!-- <div class="mb-3">
                        <label for="share_code" class="form-label">Share Code (4 characters):</label>
                        <input type="text" name="share_code" id="share_code" maxlength="4" class="form-control" required>
                    </div> -->

                    <!-- Hidden fields for Token and Service Type -->
                    <input type="hidden" name="token" id="modalToken" value="">
                    <input type="hidden" name="service_type" id="modalServiceType" value="KYC VERIFICATION">

                    <!-- Display Token Info -->
                    <div class="mb-3">
                        <p><strong>Service Type:</strong> <span id="modalServiceTypeDisplay"></span></p>
                        <p><strong>Token:</strong> <span id="modalTokenDisplay"></span></p>
                    </div>

                    <button type="submit" class="btn btn-primary">Generate OTP</button>
                </form>

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