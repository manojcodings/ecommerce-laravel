<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $products = Product::where('is_active', true)->latest()->take(8)->get();
        return view('shop.home', compact('categories', 'products'));
    }

    public function shop(Request $request)
    {
        $categories = Category::all();
        $products = Product::where('is_active', true);

        if ($request->category) {
            $products = $products->whereHas('category', function($query) use ($request) {
                $query->where('slug', $request->category);
            });
        }

        if ($request->search) {
            $products = $products->where('name', 'like', '%' . $request->search . '%');
        }

        $products = $products->latest()->paginate(9);
        return view('shop.index', compact('categories', 'products'));
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        $related = Product::where('category_id', $product->category_id)
                    ->where('id', '!=', $product->id)
                    ->take(4)->get();
        return view('shop.show', compact('product', 'related'));
    }
}