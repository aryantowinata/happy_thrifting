<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function index()
    {
        $products = Product::where('jumlah_produk', '>', 0)->get();
        return view('index', compact('products'));
    }

    public function about()
    {
        $products = Product::where('jumlah_produk', '>', 0)->get();
        return view('about', compact('products'));
    }

    public function product_page()
    {
        $products = Product::where('jumlah_produk', '>', 0)->get();
        return view('product_page', compact('products'));
    }
}
