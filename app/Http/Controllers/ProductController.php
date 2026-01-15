<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(12);

        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg',
        ]);

        $image = $request->file('image');
        $image->storeAs('public', $image->hashName());

        Product::create([
            'name' => $request['name'],
            'price' => $request['price'],
            'description' => $request['description'],
            'image' => $image->hashName(),
        ]);

        return redirect()->route('products.index')->with('success', 'Add product successfully!');
    }
}
