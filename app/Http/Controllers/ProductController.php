<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $imageName = $image->hashName();

        // simpan ke storage/app/public dengan nama hash
        Storage::disk('public')->putFileAs(
            '',
            $image,
            $imageName
        );

        Product::create([
            'name' => $request['name'],
            'price' => $request['price'],
            'description' => $request['description'],
            'image' => $imageName,
        ]);

        return redirect()->route('products.index')->with('success', 'Add product successfully!');
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }
}
