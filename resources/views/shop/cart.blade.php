@extends('layouts.shop')

@section('title', 'Cart - ShopZone')

@section('content')
<div class="container my-5">
    <h2 class="mb-4"><i class="fas fa-shopping-cart me-2"></i>Your Cart</h2>

    @if(count($cart) > 0)
        <div class="row">
            <!-- Cart Items -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Subtotal</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $total = 0; @endphp
                                @foreach($cart as $id => $item)
                                    @php $total += $item['price'] * $item['quantity']; @endphp
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                @if($item['image'])
                                                    <img src="{{ asset('storage/' . $item['image']) }}"
                                                         width="50" height="50"
                                                         style="object-fit: cover;" class="rounded">
                                                @else
                                                    <div class="bg-light rounded d-flex align-items-center
                                                                justify-content-center"
                                                         style="width:50px; height:50px;">
                                                        <i class="fas fa-image text-muted"></i>
                                                    </div>
                                                @endif
                                                {{ $item['name'] }}
                                            </div>
                                        </td>
                                        <td>Rs. {{ number_format($item['price'], 2) }}</td>
                                        <td>
                                            <form action="{{ route('cart.update', $id) }}"
                                                  method="POST" class="d-flex gap-2">
                                                @csrf
                                                @method('PATCH')
                                                <input type="number" name="quantity"
                                                       value="{{ $item['quantity'] }}"
                                                       min="1" class="form-control form-control-sm"
                                                       style="width: 70px;">
                                                <button type="submit" class="btn btn-sm btn-outline-primary">
                                                    Update
                                                </button>
                                            </form>
                                        </td>
                                        <td>Rs. {{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                                        <td>
                                            <form action="{{ route('cart.remove', $id) }}"
                                                  method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Order Summary</h5>
                        <hr>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal:</span>
                            <span>Rs. {{ number_format($total, 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Shipping:</span>
                            <span class="text-success">Free</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between fw-bold">
                            <span>Total:</span>
                            <span class="text-primary">Rs. {{ number_format($total, 2) }}</span>
                        </div>
                        <a href="{{ route('checkout.index') }}"
                           class="btn btn-primary w-100 mt-3">
                            <i class="fas fa-credit-card me-2"></i>Proceed to Checkout
                        </a>
                        <a href="{{ route('shop') }}"
                           class="btn btn-outline-secondary w-100 mt-2">
                            Continue Shopping
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="text-center py-5">
            <i class="fas fa-shopping-cart fa-5x text-muted mb-4"></i>
            <h4>Your cart is empty!</h4>
            <a href="{{ route('shop') }}" class="btn btn-primary mt-3">
                Start Shopping
            </a>
        </div>
    @endif
</div>
@endsection