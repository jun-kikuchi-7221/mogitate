@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}" />
<link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inika&display=swap" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <!-- 商品一覧タイトルと追加ボタン -->
    <div class="header-row">
        <h1>商品一覧</h1>
        <a href="{{ route('products.create') }}" class="add-product-button">+ 商品を追加</a>
    </div>

    <!-- メインコンテンツ -->
    <div class="main-content">
        <!-- 検索フォーム -->
        <div class="search-section">
            <form action="{{ route('products.search') }}" method="GET">
                <div class="search-item">
                    <label for="search">商品名で検索</label>
                    <input type="text" id="search" name="search" placeholder="商品名を入力" value="{{ request('search') }}">
                </div>
                <div class="search-item">
                    <label for="price">価格順で表示</label>
                    <select id="price" name="sort">
                        <option value="">価格で並べ替え</option>
                        <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>価格の安い順</option>
                        <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>価格の高い順</option>
                    </select>
                </div>
                <div class="search-item">
                    <button type="submit" class="search-button">検索</button>
                </div>
            </form>
        </div>

        <!-- 商品一覧 -->
        <div class="product-list">
            @foreach ($products as $product)
                <div class="product">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                    <h2>{{ $product->name }}</h2>
                    <p>¥{{ number_format($product->price) }}</p>
                </div>
            @endforeach
        </div>
    </div>

    <!-- ページネーション -->
    <div class="pagination">
        {{ $products->withQueryString()->links('pagination::bootstrap-4') }}
    </div>
</div>
@endsection