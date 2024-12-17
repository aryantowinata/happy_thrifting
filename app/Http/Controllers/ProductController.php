<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $kategories = Kategori::all();
        $products = Product::with('kategori')->get();
        return view('admin.products', compact('products', 'kategories'));
    }

    public function store(Request $request)
    {
        // Validasi form input
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'kategori_produk' => 'required|string', // Nama kategori dari form
            'harga_produk' => 'required|numeric',
            'jumlah_produk' => 'required|numeric',
            'gambar_produk' => 'required|image|max:2048',
        ]);

        // Cari ID kategori berdasarkan nama
        $kategori = Kategori::where('nama_kategori', $request->kategori_produk)->first();
        if (!$kategori) {
            return redirect()->back()->with('error', 'Kategori tidak ditemukan.');
        }

        // Simpan file gambar ke storage
        $path = $request->file('gambar_produk')->store('products', 'public');

        // Buat produk baru
        Product::create([
            'id_user' => Auth::id(),
            'nama_produk' => $request->nama_produk,
            'id_kategori' => $kategori->id, // Simpan ID kategori
            'harga_produk' => $request->harga_produk,
            'jumlah_produk' => $request->jumlah_produk,
            'gambar_produk' => $path,
        ]);

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function update(Request $request, Product $product)
    {
        // Validasi input
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'kategori_produk' => 'required|string', // Nama kategori dari form
            'harga_produk' => 'required|numeric',
            'jumlah_produk' => 'required|numeric',
            'gambar_produk' => 'nullable|image|max:2048',
        ]);

        // Cari ID kategori berdasarkan nama
        $kategori = Kategori::where('nama_kategori', $request->kategori_produk)->first();
        if (!$kategori) {
            return redirect()->back()->with('error', 'Kategori tidak ditemukan.');
        }

        // Update gambar jika ada
        if ($request->hasFile('gambar_produk')) {
            if ($product->gambar_produk && Storage::exists('public/' . $product->gambar_produk)) {
                Storage::delete('public/' . $product->gambar_produk);
            }
            $product->gambar_produk = $request->file('gambar_produk')->store('products', 'public');
        }

        // Update produk
        $product->update([
            'nama_produk' => $request->nama_produk,
            'id_kategori' => $kategori->id, // Simpan ID kategori
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
