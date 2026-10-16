<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movement;
use App\Models\Product;

class MovementController extends Controller
{
    public function index()
    {
        // Mengambil semua produk untuk dropdown form
        $products = Product::orderBy('name', 'asc')->get();
        // Mengambil histori pergerakan beserta nama produknya, diurutkan dari yang terbaru
        $movements = Movement::with('product')->latest()->get();

        return view('movements.index', compact('products', 'movements'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'type' => 'required|in:in,out',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);

        // Cek apakah stok cukup jika barang dikeluarkan
        if ($request->type == 'out' && $product->stock < $request->quantity) {
            return back()->with('error', 'Gagal! Stok saat ini tidak mencukupi untuk dikeluarkan.');
        }

        // 1. Simpan Catatan Histori
        Movement::create([
            'product_id' => $request->product_id,
            'type' => $request->type,
            'quantity' => $request->quantity,
            'description' => $request->description,
        ]);

        // 2. Ubah Jumlah Stok Otomatis di Tabel Products
        if ($request->type == 'in') {
            $product->stock += $request->quantity;
        } else {
            $product->stock -= $request->quantity;
        }
        $product->save();

        return back()->with('success', 'Pergerakan stok berhasil dicatat!');
    }
}