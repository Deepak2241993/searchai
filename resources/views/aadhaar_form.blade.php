<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aadhaar Verification</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Aadhaar Verification</h2>
        <form id="aadhaar-form" action="{{ route('aadhaar.verify') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="aadhaar-number" class="form-label">Aadhaar Number</label>
                <input type="text" name="aadhaar_number" id="aadhaar-number" class="form-control" placeholder="Enter Aadhaar Number" required minlength="12" maxlength="12">
            </div>
            <div class="mb-3">
                <label for="base64" class="form-label">Base64 String</label>
                <textarea name="base64" id="base64" class="form-control" rows="4" placeholder="Enter Base64 String" required></textarea>
            </div>
            <div class="mb-3">
                <label for="share-code" class="form-label">Share Code</label>
                <input type="text" name="share_code" id="share-code" class="form-control" placeholder="Enter 4-Digit Share Code" required minlength="4" maxlength="4">
            </div>
            <div class="mb-3">
                <label for="consent" class="form-label">Consent</label>
                <select name="consent" id="consent" class="form-select" required>
                    <option value="Y">Yes</option>
                    <option value="N">No</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Verify Aadhaar</button>
        </form>
    </div>

    <script>
        $(document).ready(function () {
            $('#aadhaar-form').on('submit', function (e) {
                e.preventDefault();
                const form = $(this);
                const formData = form.serialize();

                $.ajax({
                    url: form.attr('action'),
                    method: 'POST',
                    data: formData,
                    success: function (response) {
                        if (response.status === 'success') {
                            Swal.fire('Success', 'Aadhaar verified successfully!', 'success');
                        } else {
                            Swal.fire('Error', response.message || 'Verification failed', 'error');
                        }
                    },
                    error: function (xhr) {
                        Swal.fire('Error', 'Something went wrong. Please try again.', 'error');
                    }
                });
            });
        });
    </script>
</body>
</html>
