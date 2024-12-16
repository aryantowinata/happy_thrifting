<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.products', compact('products'));
    }

    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga_produk' => 'required|numeric',
            'jumlah_produk' => 'required|numeric',
            'gambar_produk' => 'required|image|max:2048', // Max 2MB
        ]);

        // Simpan file gambar ke storage
        $path = $request->file('gambar_produk')->store('products', 'public');

        // Buat produk baru
        Product::create([
            'id_user' => Auth::id(), // Ambil ID user saat ini
            'nama_produk' => $request->nama_produk,
            'harga_produk' => $request->harga_produk,
            'jumlah_produk' => $request->jumlah_produk,
            'gambar_produk' => $path,
        ]);

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan!');
    }


    public function update(Request $request, Product $product)
    {
        // Validasi data
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga_produk' => 'required|numeric',
            'jumlah_produk' => 'required|numeric',
            'gambar_produk' => 'nullable|image|max:2048', // Opsional jika gambar tidak diubah
        ]);

        // Jika gambar diupload, hapus gambar lama dan simpan yang baru
        if ($request->hasFile('gambar_produk')) {
            // Hapus gambar lama jika ada
            if ($product->gambar_produk && Storage::exists('public/' . $product->gambar_produk)) {
                Storage::delete('public/' . $product->gambar_produk);
            }

            // Simpan gambar baru
            $path = $request->file('gambar_produk')->store('products', 'public');
            $product->gambar_produk = $path;
        }

        // Perbarui data produk
        $product->update([
            'nama_produk' => $request->nama_produk,
            'harga_produk' => $request->harga_produk,
            'jumlah_produk' => $request->jumlah_produk,
            'gambar_produk' => $product->gambar_produk,
        ]);

        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // Hapus gambar dari storage jika ada
        if ($product->gambar_produk && Storage::exists('public/' . $product->gambar_produk)) {
            Storage::delete('public/' . $product->gambar_produk);
        }

        // Hapus produk
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus!');
    }
}
