@extends('layouts.shop')

@section('title', 'Shop - ShopZone')

@section('content')
<div class="container my-5">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3">
            <div class="card p-3">
                <h5 class="mb-3">Filter Products</h5>
                <form action="{{ route('shop') }}" method="GET">
                    <!-- Search -->
                    <div class="mb-3">
                        <label class="form-label fw-bold">Search</label>
                        <input type="text" name="search" class="form-control"
                               placeholder="Search products..." value="{{ request('search') }}">
                    </div>
                    <!-- Categories -->
                    <div class="mb-3">
                        <label class="form-label fw-bold">Categories</label>
                        @foreach($categories as $category)
                            <div class="form-check">
                                <input class="form-check-input" type="radio"
                                       name="category" value="{{ $category->slug }}"
                                       {{ request('category') == $category->slug ? 'checked' : '' }}>
                                <label class="form-check-label">{{ $category->name }}</label>
                            </div>
                        @endforeach
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Apply Filter</button>
                    <a href="{{ route('shop') }}" class="btn btn-outline-secondary w-100 mt-2">Clear</a>
                </form>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="col-md-9">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4>All Products</h4>
                <span class="text-muted">{{ $products->total() }} products found</span>
            </div>
            <div class="row">
                @forelse($products as $product)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}"
                                     class="card-img-top" style="height: 200px; object-fit: cover;">
                            @else
                                <div class="bg-light d-flex align-items-center justify-content-center"
                                     style="height: 200px;">
                                    <i class="fas fa-image fa-3x text-muted"></i>
                                </div>
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="text-muted small">{{ $product->category->name }}</p>
                                <p class="fw-bold text-primary">Rs. {{ number_format($product->price, 2) }}</p>
                                <p class="small text-muted">Stock: {{ $product->stock }}</p>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('product.show', $product->slug) }}"
                                   class="btn btn-outline-primary btn-sm w-100">View Details</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-center text-muted">No products found.</p>
                    </div>
                @endforelse
            </div>
            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>
@endsection