@extends('layouts.admin-master')

@section('title')
Token List
@endsection

@section('content')
<div class="app-content-header bg-light py-3 shadow-sm">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <h3 class="mb-0">Background Verification Token + CCRV</h3>
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
                                        @if ($Token->status == 'active' && $Token->api_status == 'active')
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
                                        @endif
                                        @if ($Token->status == 'active' && $Token->api_status == 'partially_run')
                                        <td class="text-center">
                                            
                                            <button class="btn btn-sm btn-success view-data-btn report_generate"
                                                data-bs-toggle="modal"
                                                data-bs-target="#reportgenerate"
                                                data-id="{{ $Token->id }}"
                                                data-token="{{ $Token->token }}"
                                                data-service="{{ $Token->service_type }}">
                                                Generate Report
                                            </button>
                                           
                                        </td>
                                        @endif	
                                        
                                        @if ($Token->status == 'expired' && $Token->api_status == 'completed')
                                        <td class="text-center">
                                        <a href="{{ route('reportgenerate', $Token->id) }}" class="btn btn-sm btn-secondary">
                                            Download Report
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
                <form id="aadhaarOtpForm" action="{{ route('background-otpgeneration') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="aadhaar_number" class="form-label">Aadhaar Number:</label>
                        
                        <input type="text" name="aadhaar_number" id="aadhaar_number" class="form-control" required pattern="\d{12}" maxlength="12">

                    </div>
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



{{--  For OPT Verification Code --}}
<div class="modal fade" id="optverification" tabindex="-1" aria-labelledby="optverificationLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="optverificationLabel">Generate OTP</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Aadhaar OTP Generation Form -->
                <form action="{{ route('kyc-otp') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <label for="otp">OTP:</label>
                            <input class= "form-control" type="text" name="otp" id="otp" required>
                            <input type="hidden" name="transaction_id" value="" required>
                            <input type="hidden" name="token_share_code" value="" required>
                            <input type="hidden" name="aadhaar_number" id="aadhaar_number_otp">
                            <input type="hidden" name="service_type" value="KYC VERIFICATION">
                        </div>
                        <div class="col-md-6 mt-4">
                            <button type="submit" class="btn btn-success">Verify OTP</button>
                        </div>
                        <p id="successmessage" class="text-success d-none"></p>
                    </div> 
                </form>

            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
 document.addEventListener("DOMContentLoaded", function () {
    // Handle modal opening and set data attributes
    document.querySelectorAll(".open-modal-btn").forEach((button) => {
        button.addEventListener("click", function () {
            const serviceType = this.getAttribute("data-service");
            const token = this.getAttribute("data-token");

            // Set modal values
            document.getElementById("modalToken").value = token;
            document.getElementById("modalServiceTypeDisplay").textContent = serviceType;
            document.getElementById("modalTokenDisplay").textContent = token;
        });
    });

    // Handle Aadhaar OTP Form Submission via AJAX
    document.getElementById("aadhaarOtpForm").addEventListener("submit", function (event) {
        event.preventDefault(); // Prevent normal form submission

        let aadhaarNumber = document.getElementById("aadhaar_number").value.trim();
    if (!/^\d{12}$/.test(aadhaarNumber)) {
        alert("Please enter a valid 12-digit Aadhaar number.");
        event.preventDefault();
        return;
    }
        let formData = new FormData(this);
        let submitButton = this.querySelector("button[type='submit']");

        // Show spinner and disable button
        submitButton.innerHTML = `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing...`;
        submitButton.disabled = true;

        fetch(this.action, {
            method: "POST",
            body: formData,
            headers: {
                "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value,
            },
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Hide Aadhaar OTP modal before opening the next modal
                    let aadhaarOtpModal = bootstrap.Modal.getInstance(document.getElementById("aadhaarOtpModal"));
                    aadhaarOtpModal.hide();

                    setTimeout(() => {
                        // Populate second modal hidden fields with response data
                        document.querySelector('input[name="transaction_id"]').value = data.transaction_id;
                        document.querySelector('input[name="token_share_code"]').value = data.token_share_code;
                        document.getElementById('aadhaar_number_otp').value = data.aadhaar_number;
                        document.querySelector('input[name="service_type"]').value = data.service_type;

                        // Show OTP verification modal
                        let otpVerificationModal = new bootstrap.Modal(document.getElementById("optverification"));
                        otpVerificationModal.show();
                       
                    }, 500); // Small delay to ensure first modal is completely hidden
                } else {
                    alert("Error: " + data.message);
                }
            })
            .catch(error => console.error("Error:", error))
            .finally(() => {
                // Reset button state
                submitButton.innerHTML = "Generate OTP";
                submitButton.disabled = false;
            });
    });

    document.querySelector('#optverification form').addEventListener("submit", function (event) {
    event.preventDefault(); // Prevent normal form submission

    let formData = new FormData(this);
    let submitButton = this.querySelector("button[type='submit']");

    // Show spinner and disable button
    submitButton.innerHTML = `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Verifying...`;
    submitButton.disabled = true;

    fetch(this.action, {
        method: "POST",
        body: formData,
        headers: {
            "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value,
        },
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Failed to submit OTP');
        }
        return response.json();
    })
    .then(data => {
    if (data.success) {
        // Show success message
        const successMessage = document.getElementById('successmessage');
        if (successMessage) {
            successMessage.textContent = 'OTP Verified';
            successMessage.classList.remove('d-none');
        }

        // Hide OTP verification modal
        const otpVerificationModal = bootstrap.Modal.getInstance(document.getElementById('optverification'));
        if (otpVerificationModal) {
            otpVerificationModal.hide();
        }
    alert('Click on Generate Report to Proceed');
        // Reload page after a short delay for smooth transition
        setTimeout(() => {
            location.reload();
        }, 1000);
    } else {
        // Handle failure case with fallback for missing messages
        alert(`OTP Verification Failed: ${data.message ?? 'Please try again.'}`);
    }
})

    .catch(error => {
        console.error("Error:", error);
        alert("An error occurred. Please try again.");
    })
    .finally(() => {
        // Reset button state
        submitButton.innerHTML = "Verify OTP";
        submitButton.disabled = false;
    });
});


});

//  For Report Generate
$(document).ready(function () {
    $(".report_generate").on("click", function () {
        let button = $(this); // Store the button reference
        let tokenId = button.data("id");
        let tokenValue = button.data("token");
        let serviceType = button.data("service");

        // Disable button and show spinner
        button.prop("disabled", true).html(`
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Generating...
        `);

        $.ajax({
            url: "{{ route('ccrv-report-generation') }}", // Ensure this route is correctly defined
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}", 
                token_id: tokenId,
                token: tokenValue,
                service_type: serviceType
            },
            dataType: "json", // Ensures JSON response is parsed correctly
            success: function (response) {
                if (response.success) {
                    // Reload the page after a short delay (1.5 seconds)
                    setTimeout(function () {
                        location.reload();
                    }, 1500);
                }
            },
            error: function (xhr) {
                alert(xhr.responseJSON?.message || "Something went wrong!");
            },
            complete: function () {
                // Restore button state after request completes
                button.prop("disabled", false).html("Generate Report");
            }
        });
    });
});




</script>


@endsection