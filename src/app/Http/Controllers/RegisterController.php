<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Models\Season;
use App\Models\Product;

class RegisterController extends Controller
{
    // 商品の登録と更新に関するロジックを管理します。
    public function create()
    {
        return view('register');
    }

    public function store(RegisterRequest $request)
    {
        // バリデーション済みデータを取得
        $validated = $request->validated();

        // 商品画像の保存
        if ($request->hasFile('image')) {
            // 元のファイル名を取得し、不正な文字を取り除く
            $originalName = $request->file('image')->getClientOriginalName();
            $safeName = preg_replace('/[^a-zA-Z0-9_\.\-]/', '_', $originalName);
            // ファイルを指定した名前で保存
            $path = $request->file('image')->storeAs('images', $safeName, 'public');
            $validated['image'] = $path; // ここでそのまま保存
        }

       
        // 商品データを保存
        $product = Product::create($validated);

        // 季節データを保存
        if ($request->has('season')) {
            // 選択された季節（名前）をIDに変換して保存
            $seasonIds = Season::whereIn('name', $request->input('season'))->pluck('id')->toArray();
            $product->seasons()->sync($seasonIds);
        }


        return redirect()->route('products.index');

    }
}


