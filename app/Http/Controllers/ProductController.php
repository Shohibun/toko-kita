<?php

namespace App\Http\Controllers;

use App\Models\Product; // Product → model database products
use Illuminate\Http\Request; // Request → menangani input form
use Illuminate\Support\Facades\Storage; // Storage → mengelola file (upload, delete, dll)

class ProductController extends Controller
{
    public function index() // Mengambil data produk dari database
    {
        $products = Product::paginate(12); // Pagination 12 produk per halaman

        return view('products.index', compact('products')); // Mengirim data ke view products.index
    }

    public function create() // Menampilkan form tambah produk
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([ // Validasi wajib form add product
            'name' => 'required',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg',
        ]);

        // Upload image
        $image = $request->file('image');
        $imageName = $image->hashName(); // Membuat nama file unik otomatis

        // Simpan ke storage/app/public dengan nama hash
        Storage::disk('public')->putFileAs(
            '', // Langsung ke root folder
            $image,
            $imageName
        );

        // Simpan data ke database
        Product::create([
            'name' => $request->name,
            'price' => str_replace('.', '', $request->price), // Untuk menghapus titik pada harga
            'description' => $request->description,
            'image' => $imageName,
        ]);

        // 'success' disini parameter untuk mengirimkan pesan ke view
        return redirect()->route('products.index')->with('success', 'Add product successfully!');
    }

    public function edit(Product $product) // Laravel route model binding
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
        ]);

        // Update data text
        $product->name = $request->name;
        $product->price = str_replace(".", "", $request->price);
        $product->description = $request->description;

        // Update image
        if ($request->file('image')) {
            if ($product->image !== 'noimage.png') { // Hapus image lama, selain noimage.png
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

        $product->update(); // Menyimpan ke database
        return redirect()->route('products.index')->with('success', 'Update product successfully!');
    }

    public function destroy(Product $product)
    {
        if ($product->image !== 'noimage.png') { // noimage.png tidak ikut terhapus
            Storage::disk('public')->delete($product->image);
        }

        $product->delete(); // Menghapus data di database
        return redirect()->route('products.index')->with('success', 'Delete product successfully!');
    }
}
