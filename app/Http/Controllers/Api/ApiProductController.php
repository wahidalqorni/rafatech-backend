<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;

class ApiProductController extends Controller
{
    public function listProduct()
    {
        try {
            // menampilkan halaman list product
            $data = Product::where('status', 'Publish')->orderBy('nama_product')->get(); // SELECT * FROM products ORDER BY nama_product ASC

            // distribusikan datanya
            return response()->json([
                'success' => true,
                'message' => "Success",
                'product'    => $data
            ], 200);

            //HTTP Status Code (200 (success), 404 (not found), 500(error server), dll)
        } catch (Exception $error) {
            return response()->json([
                'success' => false,
                'message' => "Failed : " . $error->getMessage(),
                'product'    => null
            ], 500);
        }
    }

    public function detailProduct($id)
    {
        try {
            $data = Product::where('id', $id)->first();
            if ($data) {
                // distribusikan datanya
                return response()->json([
                    'success' => true,
                    'message' => "Success",
                    'product'    => $data
                ], 200);
            } else {
                // distribusikan datanya
                return response()->json([
                    'success' => false,
                    'message' => "Not Found",
                    'product'    => $data
                ], 404);
            }
        } catch (Exception $error) {
            return response()->json([
                'success' => false,
                'message' => "Failed : " . $error->getMessage(),
                'product'    => null
            ], 500);
        }
    }

    public function searchProduct(Request $request)
    {
        $keyword = $request->keyword;

        try {
            $data = Product::where('status', 'Publish')
                ->where('nama_product', 'like', '%' . $keyword . '%')
                ->orWhere('kategori', 'like', '%' . $keyword . '%')
                ->get();
            if ($data) {
                // distribusikan datanya
                return response()->json([
                    'success' => true,
                    'message' => "Success",
                    'hotel'    => $data
                ], 200);
            } else {
                // distribusikan datanya
                return response()->json([
                    'success' => false,
                    'message' => "Not found",
                    'product'    => $data // []
                ], 404);
            }
        } catch (Exception $error) {
            return response()->json([
                'success' => false,
                'message' => "Failed : " . $error->getMessage(),
                'product'    => null
            ], 500);
        }
    }
}
