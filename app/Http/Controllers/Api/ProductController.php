<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    public function index()
    {
        return Product::with('category')->paginate(10);
    }

    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['name']);
        $data['image'] = $request->file('image') ? $request->file('image')->store('products', 'public') : null;
        if (!isset($data['status'])) {
            $data['status'] = 1;
        }
        $product = Product::create($data);
        return response()->json($product, 201);
    }

    public function show(Product $product)
    {
        $product->load('category');
        $product->image_url = $product->image ? asset('storage/' . $product->image) : null;
        return $product;
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        } else {
            unset($data['image']);
        }

        if (isset($data['name'])) {
            $data['slug'] = Str::slug($data['name']);
        }

        $product->update($data);
        return response()->json($product);
    }

    public function destroy(Product $product)
    {
        $product->delete();
    }

    public function byCategory($category)
    {
        $query = Product::with('category');

        if (is_numeric($category)) {
            $query->where('category_id', $category);
        } else {
            $query->whereHas('category', function ($q) use ($category) {
                $q->where('name', $category);
            });
        }

        return $query->paginate(10);
    }
}
