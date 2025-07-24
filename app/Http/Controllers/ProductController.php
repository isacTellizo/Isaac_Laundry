<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{
    public function getProduct($id)
    {
        $product = Product::whereId($id)->first();
        if (!$product) {
            return response()->json([
                "success" => false,
                "product" => null,
                'message' => 'Product Not Found ',
            ]);
        } elseif ($product = new ProductResource(Product::whereId($id)->first())) {
            return response()->json([
                "success" => true,
                "product" => $product,
                'message' => ' Product Found',
            ]);
        }
    }
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

    public function createProduct(Request $request)
    {
        try {
            $validated = $request->validate([
                "name" => "required",
                "unit_id" => "required",
                "category_id" => "required",
                "sku" => "required|unique:products,sku,",
            ]);
        } catch (ValidationException $e) {
            $errors = [];

            foreach ($e->errors() as $field => $messages) {
                $errors[] = [
                    'error_field' => $field,
                    'message' => $messages[0]
                ];
            }
            return response()->json([
                'success' => false,
                'errors' => $errors,
                'test error' => $e->errors(),
            ], 422);
        }
        try {
            $product = new Product();
            $product->name = $request->name;
            $product->unit_id = $request->unit_id;
            $product->category_id = $request->category_id;
            $product->sku = $request->sku;
            $product->opening_stock = $request->opening_stock;
            $product->description = $request->description;
            $product->is_active = $request->is_active;
            $product->purchase_price = $request->purchase_price;
            $product->save();
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
        return response()->json([
            "success" => true,
            'product' => new ProductResource($product),
        ]);
    }

    public function updateProduct(Request $request, $id)
    {
        $product = Product::whereId($id)->first();
        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'No Product Found',
            ]);
        }
        if ($request->getMethod() == 'GET') {
            return response()->json([
                'success' => true,
                'product' => $product,
            ]);
        }
        try {
            $validated = $request->validate([
                "name" => "required",
                "unit_id" => "required",
                "category_id" => "required",
                "sku" => "required|unique:products,sku," . $id,
            ]);
        } catch (ValidationException $e) {
            $errors = [];

            foreach ($e->errors() as $field => $messages) {
                $errors[] = [
                    'error_field' => $field,
                    'message' => $messages[0]
                ];
            }
            return response()->json([
                'success' => false,
                'errors' => $errors,
            ], 422);
        }
        try {
            $product->name = $request->name;
            $product->unit_id = $request->unit_id;
            $product->category_id = $request->category_id;
            $product->sku = $request->sku;
            $product->opening_stock = $request->opening_stock;
            $product->description = $request->description;
            $product->is_active = $request->is_active;
            $product->purchase_price = $request->purchase_price;
            $product->save();
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
        return response()->json([
            "success" => true,
            'product' => new ProductResource($product),
        ]);
    }
}
