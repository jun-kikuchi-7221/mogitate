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

        // ページネーションと検索結果を取得
        $products = $query->paginate(6)->appends($request->query());

        return view('index', compact('products', 'request', 'search'));
    }

    
}