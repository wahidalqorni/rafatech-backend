<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        // menampilkan halaman list product
        $data = Product::orderBy('nama_product','ASC')->get();
        return view('backend.product.index', compact('data'));
    }

    // menampilkan form tambah
    public function add()
    {
        return view('backend.product.add');
    }

    // fungsi untuk memasukkan data ke dalam tabel database
    public function store(Request $request)
    {
        $request->validate([
            'kode_product' => 'required|unique:products',
            'nama_product' => 'required',
            'kategori' => 'required',
            'harga' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'required|image|file|max:2048'
        ]);

        try {
            // upload file
            $pathGambar = $request->file('gambar')->store('product-images');

            // function insert datanya
            Product::create([
                'kode_product' => $request->kode_product,
                'nama_product' => $request->nama_product,
                'gambar' => $pathGambar,
                'kategori' => $request->kategori,
                'harga' => $request->harga,
                'deskripsi' => $request->deskripsi,
                'status' => $request->status,
            ]);

            return redirect('product')->with([
                'success' => 'Insert data success!'
            ]);
        } catch (Exception $error) {
            return redirect()->back()->with([
                'error' => "Error : " . $error->getMessage()
            ]);
        }
    }

    public function edit($id)
    {
        $data = Product::where('id', $id)->first(); // SELECT * FROM products WHERE id = $id

        return view('backend.product.edit', compact('data'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama_product' => 'required',
            'kategori' => 'required',
            'harga' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'nullable|image|max:2048'
        ]);

        try {

            // ambil data product yg dipilih berdasarkan idnya
            $product = Product::find($request->id);

            // cek apakah user mengupload file baru
            if ($request->file('gambar')) {

                // hapus file lamanya
                Storage::delete($product->gambar);

                // upload file baru
                $pathGambar = $request->file('gambar')->store('product-images');
            } else {
                // kalo tidak upload, ambil nilai lama pd field gambar
                $pathGambar = $product->gambar; //product-images/namafile.ekstensi
            }

            $product->update([
                'nama_product' => $request->nama_product,
                'gambar' => $pathGambar,
                'kategori' => $request->kategori,
                'harga' => $request->harga,
                'deskripsi' => $request->deskripsi,
                'status' => $request->status,
            ]);

            return redirect('product')->with([
                'success' => 'Update data success!'
            ]);
        } catch (Exception $error) {
            return redirect()->back()->with([
                'error' => 'Error : ' . $error->getMessage()
            ]);
        }
    }

    public function delete($id)
    {
        try {
            // ambil dulu data product yg dipilih berdasarkan id
            // fungsinya untuk mengambil nilai gambar agar bisa diseleksi dan dihapus filenya
            $data = Product::find($id);

            // hapus filenya jika ada
            if ($data->gambar) {
                // hapus filenya
                Storage::delete($data->gambar);
            }

            // hapus data record pd tabel products berdasarkan id
            Product::destroy($id);

            // arahkan kembali ke route yg namanya product
            return redirect('product')->with([
                'success' => 'Delete data success!'
            ]);

        } catch (Exception $error) {
            return redirect()->back()->with([
                'error' => 'Error : ' . $error->getMessage()
            ]);
        }
    }
}
