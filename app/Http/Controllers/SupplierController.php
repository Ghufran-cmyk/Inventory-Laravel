<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;

class SupplierController extends Controller
{
    public function index()
    {
        // Mengambil semua data supplier dari yang terbaru
        $suppliers = Supplier::latest()->get();
        return view('suppliers.index', compact('suppliers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'contact' => 'required',
            'address' => 'required',
        ]);

        Supplier::create([
            'name' => $request->name,
            'contact' => $request->contact,
            'address' => $request->address,
        ]);

        return back()->with('success', 'Supplier baru berhasil ditambahkan!');
    }
}