<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $kategoriDipilih = $request->query('category');
        $search = $request->query('search');
        
        // Menangkap pilihan dropdown (default-nya 'latest' / terbaru)
        $sort = $request->query('sort', 'latest');

        $query = Product::query();

        // 1. Logika Kategori
        if ($kategoriDipilih) {
            $query->where('category', $kategoriDipilih);
        }

        // 2. Logika Kolom Pencarian
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%");
            });
        }

        // 3. Logika 4 Pilihan Pengurutan
        if ($sort == 'cheapest') {
            $query->orderBy('price', 'asc'); // Termurah (dari kecil ke besar)
        } elseif ($sort == 'most_expensive') {
            $query->orderBy('price', 'desc'); // Termahal (dari besar ke kecil)
        } elseif ($sort == 'alphabetical') {
            $query->orderBy('name', 'asc'); // Abjad A-Z
        } else {
            $query->orderBy('id', 'desc'); // Terbaru (default)
        }

        $products = $query->get();

        return view('products.index', compact('products', 'kategoriDipilih'));
    }

    public function create()
    {
        // Membuat daftar kategori secara manual karena kita menggunakan kolom string
        $categories = [
            'Kamera & Lensa',
            'Aksesori & Stabilizer',
            'Audio & Recording',
            'Studio & Alat Desain',
            'Lainnya'
        ];

        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        Product::create([
            'category' => $request->category, // Diubah menjadi category (bukan category_id)
            'sku' => $request->sku,
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            // minimum_stock dihapus karena tidak ada di tabel database
            'image' => $imagePath,
        ]);

        return redirect('/products');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        
        $categories = [
            'Kamera & Lensa',
            'Aksesori & Stabilizer',
            'Audio & Recording',
            'Studio & Alat Desain',
            'Lainnya'
        ];

        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $updateData = [
            'category' => $request->category, // Diubah menjadi category
            'sku' => $request->sku,
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
        ];

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $updateData['image'] = $imagePath;
        }

        $product->update($updateData);

        return redirect('/products');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect('/products');
    }
}