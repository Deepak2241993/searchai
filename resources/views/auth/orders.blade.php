@extends('layouts.admin-master')
@section('title')
    User Orders
@endsection
@section('content')
    <div class="app-content-header bg-light py-3 shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h3 class="mb-0">Orders List</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end mb-0">
                        <li class="breadcrumb-item"><a href="#" class="text-decoration-none">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Orders List</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="app-content py-4">
        <div class="container-fluid">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body d-flex justify-content-between align-items-center rounded">
                    <h4 class="card-title mb-0">Manage Orders</h4>
                    
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
                                            <th>Order</th>
                                            <th>Service Type</th>
                                            <th>Total Token</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>View Token</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($data as $key => $token)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>OT{{ $token->id }}</td>
                                                <td>Kyc Verification</td>
                                                <td>{{ $token->tokens_purchased }}</td>
                                                <td>{{ \Carbon\Carbon::parse($token->created_at)->format('d-m-Y H:i A') }}</td>
                                                <td> {{ $token->status == 'paid' ? 'Paid' : 'pending' }}</td>
                                                <td>
                                                    <!-- View Icon -->
                                                    <a href="#" class="btn btn-primary btn-sm" onclick="viewToken({{ $token->id }})">
    <i class="fa fa-eye"></i> View
</a>

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
    <div class="modal fade" id="viewTokenModal" tabindex="-1" aria-labelledby="viewTokenModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewTokenModalLabel">Token Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Order ID:</strong> <span id="order-id"></span></p>
                <p><strong>Total Tokens:</strong> <span id="total-tokens"></span></p>
                <p><strong>Status:</strong> <span id="status"></span></p>
                <p><strong>Date:</strong> <span id="date"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var alerts = document.querySelectorAll('.alert');
        alerts.forEach(function(alert) {
            setTimeout(function() {
                var bootstrapAlert = new bootstrap.Alert(alert);
                bootstrapAlert.close();
            }, 2000);
        });
    });
</script>
<script>
    function deleteFaq(faqId) {
        if (confirm('Are you sure you want to delete this FAQ?')) {
            fetch(`{{ url('admin/faq') }}/${faqId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                    location.reload(); // Refresh the page or remove the row
                } else {
                    alert(data.message || 'Something went wrong!');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while deleting the FAQ.');
            });
        }
    }

    function viewToken(tokenId) {
    fetch(`{{ url('admin/token') }}/${tokenId}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('order-id').innerText = `OT${data.token.id}`;
                document.getElementById('total-tokens').innerText = data.token.tokens_purchased;
                document.getElementById('status').innerText = data.token.status === 'paid' ? 'Paid' : 'Pending';
                document.getElementById('date').innerText = data.token.created_at;

                // Show the modal
                var viewTokenModal = new bootstrap.Modal(document.getElementById('viewTokenModal'));
                viewTokenModal.show();
            } else {
                alert(data.message || 'Failed to fetch token details.');
            }
        })
        .catch(error => {
            console.error('Error fetching token details:', error);
            alert('An error occurred while fetching token details.');
        });
}

</script>
@endsection