<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        // データ取得とページネーション
        $products = $query->paginate(6);

        return view('index', compact('products'));
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

    
}