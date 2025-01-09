@extends('layouts.admin-master')
@section('title')
Total Orders List
@endsection
@section('content')
<div class="app-content-header bg-light py-3 shadow-sm">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <h3 class="mb-0">Faqs List</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end mb-0">
                    <li class="breadcrumb-item"><a href="#" class="text-decoration-none">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Total Orders List</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="app-content py-4">
    <div class="container-fluid">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body d-flex justify-content-between align-items-center rounded">
                <h4 class="card-title mb-0">Manage Orders List</h4>
                
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
                                        <!-- <th>ID</th> -->
                                        <th>User Name</th>
                                        <th>Razorpay Order ID</th>
                                        <th>Amount</th>
                                        <th>Currency</th>
                                        <th>Status</th>
                                        <th>Tokens Purchased</th>
                                        <th>Service Name</th>
                                        <th>Created At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data as $key => $order)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td> <!-- Row number -->
                                        <!-- <td>{{ $order->id }}</td> -->
                                        <td>{{ $order->user->name ?? 'N/A' }}</td>
                                        <td>{{ $order->razorpay_order_id }}</td>
                                        <td>${{ number_format($order->amount, 2) }}</td>
                                        <td>{{ strtoupper($order->currency) }}</td>
                                        <td>{{ ucfirst($order->status) }}</td>
                                        <td>{{ $order->tokens_purchased ?? 'N/A' }}</td>
                                        <td>{{ $order->serviceName ?? 'N/A' }}</td>
                                        <td>{{ $order->created_at ? $order->created_at->format('d-m-Y H:i') : 'N/A' }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="10" class="text-center text-muted">No data found.</td>
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
@endsection
@section('scripts')

@endsection