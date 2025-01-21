<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\register;
use App\Models\Product;

class RegisterController extends Controller
{
    // 商品の登録と更新に関するロジックを管理します。
    public function create()
    {
        return view('register');
    }

    public function store(Register $request)
    {
        // バリデーション済みデータを取得
        $validated = $request->validated();

        // 商品画像の保存
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            // $validated['image'] = str_replace('public/', 'storage/', $path);
            $validated['image'] = $path; // ここでそのまま保存
        }

        // データベースへ保存
        Product::create($validated);

        return redirect()->route('products.index')->with('success', '商品が登録されました！');
    }
}


