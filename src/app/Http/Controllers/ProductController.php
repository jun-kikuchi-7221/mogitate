<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductController extends Controller
{
    // 商品一覧、検索、詳細、削除のロジックを管理します。
    public function index(Request $request)
    {
        // ソート順を取得
        $sortDirection = $request->input('sort', 'asc'); // デフォルト値を 'asc' に設定

        // ソート順を検証
        if (!in_array($sortDirection, ['asc', 'desc'])) {
            $sortDirection = 'asc'; // 不正な値の場合はデフォルトに戻す
        }

        // データベースから商品を取得
        $products = Product::orderBy('price', $sortDirection)->paginate(6);
        return view('index', compact('products'));
    }

    public function search(Request $request)
    {
        $query = Product::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $sortDirection = $request->input('sort', 'asc'); // デフォルトを 'asc' に設定

        $products = Product::orderBy('price', $sortDirection)
        ->paginate(6)
        ->withQueryString(); // 現在のクエリ文字列を維持

        return view('index', compact('products', 'request'));
    }

    public function show($productId)
    {
        $product = Product::findOrFail($productId);
        return view('show', compact('product'));
    }

    public function destroy($productId)
    {
        $product = Product::findOrFail($productId);
        $product->delete();

        return redirect()->route('products.index')->with('success', '商品を削除しました。');
    }
}