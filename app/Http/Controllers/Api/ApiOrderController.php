<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ApiOrderController extends Controller
{
    public function postOrder(Request $request)
    {

        // tampung nilai product_id yg diinput
        $product_id = $request->product_id;
        // ambil data product berdasarkan product_id yg diinputkan
        $product = Product::where('id', $product_id)->where('status','Publish')->first();

        try {
            // jika data product tidak ditemukan
            if (!$product) {
                return response()->json([
                    'success' => false,
                    'message' => "Not Found",
                    'pesanan'    => null
                ], 404);
            } else {
                $harga = $product->harga;
                $post = Order::create([
                    'kode_order' => 'RFT-' . Str::random(6),
                    'product_id' => $product_id,
                    'nama' => $request->nama,
                    'no_wa' => $request->no_wa,
                    'alamat' => $request->alamat,
                    'jumlah' => $request->jumlah,
                    'total_harga' => $request->jumlah * $harga,
                ]);

                // distribusikan datanya
                return response()->json([
                    'success' => true,
                    'message' => "Success",
                    'pesanan'    => $post
                ], 200);
            }
        } catch (Exception $error) {
            // distribusikan datanya
            return response()->json([
                'success' => false,
                'message' => "Failed : " . $error->getMessage(),
                'pesanan'    => null
            ], 500);
        }
    }
}