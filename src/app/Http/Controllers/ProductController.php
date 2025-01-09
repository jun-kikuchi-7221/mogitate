<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;;

class ProductController extends Controller
{
    public function index ()
    {
        // データベースから商品を取得（例）
        // $products = Product::all();  // すべての商品を取得する場合

        // paginate(6) で、1ページあたり6件の商品を取得
        $products = Product::paginate(6);

    // 取得した商品をビューに渡す

        return view('index', compact('products'));
    }
        

}
