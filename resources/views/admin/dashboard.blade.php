@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <!-- Stats Cards -->
    <div class="col-md-3 mb-4">
        <div class="card text-white bg-primary">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="card-title">Total Products</h6>
                    <h2 class="fw-bold">{{ \App\Models\Product::count() }}</h2>
                </div>
                <i class="fas fa-box fa-3x opacity-50"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card text-white bg-success">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="card-title">Total Orders</h6>
                    <h2 class="fw-bold">{{ \App\Models\Order::count() }}</h2>
                </div>
                <i class="fas fa-shopping-cart fa-3x opacity-50"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card text-white bg-warning">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="card-title">Total Users</h6>
                    <h2 class="fw-bold">{{ \App\Models\User::count() }}</h2>
                </div>
                <i class="fas fa-users fa-3x opacity-50"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card text-white bg-danger">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="card-title">Total Revenue</h6>
                    <h2 class="fw-bold">Rs. {{ number_format(\App\Models\Order::where('status', 'completed')->sum('total_amount'), 0) }}</h2>
                </div>
                <i class="fas fa-rupee-sign fa-3x opacity-50"></i>
            </div>
        </div>
    </div>
</div>

<!-- Recent Orders -->
<div class="card mt-2">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Recent Orders</h5>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-primary">View All</a>
    </div>
    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Customer</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse(\App\Models\Order::with('user')->latest()->take(5)->get() as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->user->name }}</td>
                        <td>Rs. {{ number_format($order->total_amount, 2) }}</td>
                        <td>
                            <span class="badge
                                @if($order->status == 'completed') bg-success
                                @elseif($order->status == 'processing') bg-warning
                                @elseif($order->status == 'cancelled') bg-danger
                                @else bg-secondary @endif">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                        <td>{{ $order->created_at->format('d M Y') }}</td>
                        <td>
                            <a href="{{ route('admin.orders.show', $order) }}"
                               class="btn btn-sm btn-outline-primary">View</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">No orders yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection