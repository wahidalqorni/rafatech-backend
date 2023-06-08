<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        // menampilkan halaman list order
        $data = DB::table('orders')
            ->select('orders.*', 'products.nama_product', 'products.harga as harga_satuan', 'products.kategori', 'products.gambar')
            ->leftJoin('products', 'products.id', 'orders.product_id')
            ->get();
        return view('backend.order.index', compact('data'));
    }

    public function edit($id)
    {
        $data = DB::table('orders')
            ->select('orders.*', 'products.nama_product', 'products.harga as harga_satuan', 'products.kategori', 'products.gambar')
            ->leftJoin('products', 'products.id', 'orders.product_id')->first(); // SELECT * FROM products WHERE id = $id

        return view('backend.order.edit', compact('data'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'status' => 'required',
        ]);

        try {

            // ambil data order yg dipilih berdasarkan idnya
            $order = Order::find($request->id);

            $order->update([
                'status' => $request->status,
            ]);

            return redirect('order')->with([
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
        
            // hapus data record pd tabel orders berdasarkan id
            Order::destroy($id);

            // arahkan kembali ke route yg namanya order
            return redirect('order')->with([
                'success' => 'Delete data success!'
            ]);
        } catch (Exception $error) {
            return redirect()->back()->with([
                'error' => 'Error : ' . $error->getMessage()
            ]);
        }
    }
}
