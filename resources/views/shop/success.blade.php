@extends('layouts.shop')

@section('title', 'Order Placed - ShopZone')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6 text-center">
            <div class="card p-5 shadow">
                <div class="mb-4">
                    <i class="fas fa-check-circle text-success" style="font-size: 80px;"></i>
                </div>
                <h2 class="fw-bold text-success">Order Placed Successfully!</h2>
                <p class="text-muted mt-3">
                    Thank you for your order. We will process it shortly
                    and contact you on your provided phone number.
                </p>
                <hr>
                <div class="d-flex gap-3 justify-content-center mt-3">
                    <a href="{{ route('home') }}" class="btn btn-primary">
                        <i class="fas fa-home me-2"></i>Go to Home
                    </a>
                    <a href="{{ route('shop') }}" class="btn btn-outline-primary">
                        <i class="fas fa-shopping-bag me-2"></i>Continue Shopping
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection