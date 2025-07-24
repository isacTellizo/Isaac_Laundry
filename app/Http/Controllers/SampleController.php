<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class SampleController extends Controller
{


    public function getProducts()
    {

        $products =  ProductResource::collection(Product::get());
        if (!$products) {
            return response()->json([
                "success" => false,
                "products" => 'empty',
                'message' => 'No Products',
            ]);
        }
        return [
            "success" => true,
            "products" => $products,
            'message' => "SO MANY  PRODUCTS WOW"
        ];
    }
}
