<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        try {
            $products = Product::orderBy('name')->get();
            return view('products.index', compact('products'));
        } catch (\Exception $e) {
            return back()->withErrors([
                'error' => 'Unable to load products. Please ensure the database is properly configured.'
            ]);
        }
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:products',
            'name' => 'required',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category' => 'nullable|string'
        ]);

        try {
            Product::create($request->all());

            return redirect()->route('products.index')
                ->with('success', 'Product added successfully');
        } catch (\Exception $e) {
            return back()->withErrors([
                'error' => 'Failed to add product. Please try again.'
            ])->withInput();
        }
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'code' => 'required|unique:products,code,' . $product->id,
            'name' => 'required',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category' => 'nullable|string'
        ]);

        try {
            $product->update($request->all());

            return redirect()->route('products.index')
                ->with('success', 'Product updated successfully');
        } catch (\Exception $e) {
            return back()->withErrors([
                'error' => 'Failed to update product. Please try again.'
            ])->withInput();
        }
    }

    public function destroy(Product $product)
    {
        try {
            $product->delete();

            return redirect()->route('products.index')
                ->with('success', 'Product deleted successfully');
        } catch (\Exception $e) {
            return back()->withErrors([
                'error' => 'Failed to delete product. This product may be used in transactions.'
            ]);
        }
    }

    public function search(Request $request)
    {
        try {
            $query = $request->input('q');
            
            $products = Product::where('name', 'like', "%{$query}%")
                ->orWhere('code', 'like', "%{$query}%")
                ->get();

            return response()->json($products);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Search failed. Please try again.'
            ], 500);
        }
    }
}
