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
        $query = Product::query();

        // 検索機能
        $search = trim($request->input('search'));
        if (!empty($search)) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        // 並び替え機能
        $sort = $request->input('sort');
        if ($sort === 'asc' || $sort === 'desc') {
            $query->orderBy('price', $sort);
        }

        // データ取得とページネーション
        $products = $query->paginate(6);

        return view('index', compact('products', 'search'));
    }

    public function search(Request $request)
    {
        $query = Product::query();

        // 商品名で検索（部分一致）
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->input('search') . '%');
        }

        // 価格順で並び替え
        if ($request->filled('sort')) {
            $sortOrder = $request->input('sort') === 'asc' ? 'asc' : 'desc';
            $query->orderBy('price', $sortOrder);
        }

        // ページネーションと検索結果を取得
        $products = $query->paginate(6)->appends($request->query());

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