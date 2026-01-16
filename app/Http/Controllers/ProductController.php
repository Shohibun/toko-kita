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
            'name' => $request->name,
            'price' => str_replace('.', '', $request->price),
            'description' => $request->description,
            'image' => $imageName,
        ]);

        return redirect()->route('products.index')->with('success', 'Add product successfully!');
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
        ]);

        $product->name = $request->name;
        $product->price = str_replace(".", "", $request->price);
        $product->description = $request->description;

        if ($request->file('image')) {
            if ($product->image !== 'noimage.png') {
                Storage::disk('public')->delete($product->image);
            }
            $image = $request->file('image');
            $imageName = $image->hashName();

            // simpan ke storage/app/public dengan nama hash
            Storage::disk('public')->putFileAs(
                '',
                $image,
                $imageName
            );

            $product->image = $imageName;
        }

        $product->update();
        return redirect()->route('products.index')->with('success', 'Update product successfully!');
    }

    public function destroy(Product $product)
    {
        if ($product->image !== 'noimage.png') {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();
        return redirect()->route('products.index')->with('success', 'Delete product successfully!');
    }
}
