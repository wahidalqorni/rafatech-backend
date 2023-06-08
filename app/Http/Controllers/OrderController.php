<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        // menampilkan halaman list order
        $data = DB::table('orders')
            ->select('orders.*','products.nama_product','products.harga as harga_satuan','products.kategori')
            ->leftJoin('products','products.id','orders.product_id')
            ->first();
        return view('backend.product.index', compact('data'));
    }
}
