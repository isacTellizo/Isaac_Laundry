<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryCollection;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CategoryController extends Controller
{
    public function getCategories()
    {
        $categories = CategoryResource::collection(Category::get());
        if (!$categories) {
            return response()->json([
                'success' => false,
                'categories' => null,
                'message' => 'No Categories Found',
            ]);
        }

        return response()->json([
            'success' => true,
            'categories' => $categories,
        ]);
    }

    public function getCategory($id)
    {
        $category = Category::whereId($id)->first();
        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'No Category Found',
            ]);
        } elseif ($category = new CategoryResource(Category::whereId($id)->first())) {
            return response()->json([
                'success' => true,
                'category' => $category,
            ]);
        }
    }

    public function createCategory(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
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
                'errors' => $errors
            ]);
        }

        try {
            $category = new Category();
            $category->name = $request->name;
            $category->description = $request->description;
            $category->is_active = $request->is_active;
            $category->save();
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
        return response()->json([
            'success' => true,
            'category' => new CategoryResource($category),
        ]);
    }

    public function updateCategory(Request $request, $id)
    {
        $category = Category::whereId($id)->first();
        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'No Category Found'
            ]);
        }

        if ($request->getMethod() == 'GET') {
            return response()->json([
                'success' => true,
                'category' => $category,
            ]);
        }

        try {
            $request->validate([
                'name' => 'required',
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
                'errors' => $errors
            ]);
        }

        try {
            $category->name = $request->name;
            $category->description = $request->description;
            $category->is_active = $request->is_active;
            $category->save();
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
        return response()->json([
            'success' => true,
            'category' => new CategoryResource($category),
        ]);
    }
}
