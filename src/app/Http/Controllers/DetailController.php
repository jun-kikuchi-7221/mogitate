<?php

namespace App\Http\Controllers;

use App\Http\Requests\DetailRequest;
use App\Models\Product;
use App\Models\Season;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    public function show($id)
    {
        $product = Product::with('seasons')->findOrFail($id); // 商品情報と関連する季節を取得
        $allSeasons = Season::all(); // すべての季節を取得

        return view('detail',[
            'product' => $product,
            'allSeasons' => $allSeasons, // ここでビューに渡す
        ]);
    }

    public function update(DetailRequest $request, $id)
    {
        // 商品の取得
        $product = Product::findOrFail($id);

        // 季節のデータを同期（空の場合はリセット）
        $product->seasons()->sync($request->input('seasons', []));

        // 商品情報の更新
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->description = $request->input('description');
        // 他のデータの更新
        $product->update($request->except('seasons'));

        // 商品画像の更新
        if ($request->hasFile('product_image')) {
            // 古い画像を削除
            if ($product->image) {
                Storage::delete('public/' . $product->image);
            }
            $file = $request->file('product_image');
            $originalName = $file->getClientOriginalName(); // 元のファイル名を取得
            $path = $file->storeAs('products', $originalName, 'public'); // 元のファイル名で保存
            $product->image = $path;
        } else {
            // 新しい画像がない場合は現在の画像を保持
            $product->image = $request->input('current_image');
        }

        $product->update($request->except('product_image', 'current_image'));

        return redirect()->route('products.index');
    }

    public function destroy($productId)
    {
        $product = Product::findOrFail($productId);

        // 商品画像の削除
        if ($product->image) {
            Storage::delete('public/' . $product->image);
        }

        // 関連する季節のデータを削除
        $product->seasons()->detach();

        $product->delete();

        return redirect()->route('products.index');
    }
}

