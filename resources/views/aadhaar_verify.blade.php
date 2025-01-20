<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aadhaar Verification</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- SweetAlert2 for notifications -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.26/dist/sweetalert2.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f7f7f7;
            font-family: Arial, sans-serif;
        }
        .container {
            margin-top: 50px;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .card-header {
            background-color: #007bff;
            color: white;
            text-align: center;
            font-size: 24px;
        }
        .form-label {
            font-weight: bold;
        }
        .form-control {
            border-radius: 5px;
            box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.1);
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            font-weight: bold;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Aadhaar Number Verification
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('aadhaar.verify') }}">
                        @csrf
                        
                        <!-- Aadhaar Number Input -->
                        <div class="mb-3">
                            <label for="aadhaar_number" class="form-label">Enter Aadhaar Number</label>
                            <input type="text" name="aadhaar_number" id="aadhaar_number" class="form-control" required pattern="\d{12}" title="Enter a 12-digit Aadhaar number" placeholder="Enter 12-digit Aadhaar number">
                        </div>

                        <!-- Consent Dropdown -->
                        <div class="mb-3">
                            <label for="consent" class="form-label">Consent</label>
                            <select name="consent" id="consent" class="form-control" required>
                                <option value="Y">Yes</option>
                                <option value="N">No</option>
                            </select>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary btn-lg">Verify Aadhaar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>&copy; 2025 Aadhaar Verification | All Rights Reserved</p>
    </div>
</div>

<!-- Bootstrap 5 JS and SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.26/dist/sweetalert2.min.js"></script>

<script>
    // If there's a success or error message from the backend, show a SweetAlert notification
    @if(session('status') == 'success')
        Swal.fire({
            title: 'Success!',
            text: "{{ session('message') }}",
            icon: 'success',
            confirmButtonText: 'OK'
        });
    @elseif(session("status") == "error")
        Swal.fire({
            title: 'Error!',
            text: '{{ session('message') }}',
            icon: 'error',
            confirmButtonText: 'Try Again'
        });
    @endif
</script>

</body>
</html>
