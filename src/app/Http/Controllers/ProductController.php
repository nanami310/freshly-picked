<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // 検索と並び替えのロジック
        $query = Product::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->input('search') . '%');
        }

        if ($request->filled('sort')) {
            $query->orderBy('price', $request->input('sort'));
        }

        $products = $query->paginate(6);

        return view('products.index', compact('products'));
    }

    public function show($productId)
    {
        $product = Product::findOrFail($productId);
        return view('products.show', compact('product'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(ProductRequest $request)
    {
        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->season = json_encode($request->season ?? []); // 季節をJSON形式で保存、デフォルトは空配列

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $product->image = $imagePath;
        }

        $product->save();

        return redirect()->route('products.index')->with('success', '商品が登録されました。');
    }

    public function edit($productId)
    {
        $product = Product::findOrFail($productId);
        return view('products.edit', compact('product'));
    }

    public function update(ProductRequest $request, $productId)
    {
        $product = Product::findOrFail($productId);
        $product->update($request->validated());
        return redirect()->route('products.index');
    }

    public function destroy($productId)
    {
        $product = Product::findOrFail($productId);
        $product->delete();
        return redirect()->route('products.index');
    }

    private function validateRequest(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric|min:0|max:10000',
            'season' => 'required|array',
            'description' => 'required|string|max:120',
            'image' => 'required|image|mimes:jpeg,png',
        ]);
    }

    public function messages()
    {
        return [
            'name.required' => '商品名を入力してください。',
            'price.required' => '値段を入力してください。',
            'price.numeric' => '値段は数値で入力してください。',
            'season.required' => '季節を選択してください。',
            'description.required' => '商品説明を入力してください。',
            'image.required' => '商品画像を登録してください。',
        ];
    }

    
}