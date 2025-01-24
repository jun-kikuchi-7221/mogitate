<?php

namespace App\Http\Controllers;

use App\Http\Requests\DetailRequest;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    public function show($productId)
    {
        $product = Product::findOrFail($productId);
        
        return view('detail', compact('product'));
    }

    public function update(DetailRequest $request, Product $product)
    {
        $validated = $request->validated();

        // 画像の更新処理
        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $validated['image'] = $request->file('image')->store('images', 'public');
        }

        $product->update($validated);

        return redirect()->route('details.edit', $product)->with('success', '商品情報を更新しました！');
    }

    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();

        return redirect()->route('home')->with('success', '商品を削除しました！');
    }
}

