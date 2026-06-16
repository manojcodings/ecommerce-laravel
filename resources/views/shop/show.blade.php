@extends('layouts.shop')

@section('title', $product->name . ' - ShopZone')

@section('content')
<div class="container my-5">
    <div class="row">
        <!-- Product Image -->
        <div class="col-md-5">
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}"
                     class="img-fluid rounded shadow" style="width: 100%; object-fit: cover;">
            @else
                <div class="bg-light d-flex align-items-center justify-content-center rounded"
                     style="height: 400px;">
                    <i class="fas fa-image fa-5x text-muted"></i>
                </div>
            @endif
        </div>

        <!-- Product Details -->
        <div class="col-md-7">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('shop') }}">Shop</a></li>
                    <li class="breadcrumb-item active">{{ $product->name }}</li>
                </ol>
            </nav>
            <h2 class="fw-bold">{{ $product->name }}</h2>
            <p class="text-muted">Category: {{ $product->category->name }}</p>
            <h3 class="text-primary fw-bold">Rs. {{ number_format($product->price, 2) }}</h3>
            <p class="mt-3">{{ $product->description }}</p>

            @if($product->stock > 0)
                <p class="text-success"><i class="fas fa-check-circle"></i> In Stock ({{ $product->stock }} available)</p>
                @auth
                    <form action="{{ route('cart.add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <div class="d-flex gap-3 mt-3">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-cart-plus me-2"></i>Add to Cart
                            </button>
                            <a href="{{ route('shop') }}" class="btn btn-outline-secondary btn-lg">
                                Continue Shopping
                            </a>
                        </div>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary btn-lg mt-3">
                        <i class="fas fa-sign-in-alt me-2"></i>Login to Add to Cart
                    </a>
                @endauth
            @else
                <p class="text-danger"><i class="fas fa-times-circle"></i> Out of Stock</p>
            @endif
        </div>
    </div>

    <!-- Related Products -->
    @if($related->count() > 0)
        <div class="mt-5">
            <h4 class="mb-4">Related Products</h4>
            <div class="row">
                @foreach($related as $item)
                    <div class="col-md-3 mb-4">
                        <div class="card h-100">
                            @if($item->image)
                                <img src="{{ asset('storage/' . $item->image) }}"
                                     class="card-img-top" style="height: 180px; object-fit: cover;">
                            @else
                                <div class="bg-light d-flex align-items-center justify-content-center"
                                     style="height: 180px;">
                                    <i class="fas fa-image fa-3x text-muted"></i>
                                </div>
                            @endif
                            <div class="card-body">
                                <h6 class="card-title">{{ $item->name }}</h6>
                                <p class="text-primary fw-bold">Rs. {{ number_format($item->price, 2) }}</p>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('product.show', $item->slug) }}"
                                   class="btn btn-outline-primary btn-sm w-100">View</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection