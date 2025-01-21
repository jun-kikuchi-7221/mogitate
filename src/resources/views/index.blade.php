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
        @if (!empty($search))
            <h1>"{{ $search }}"の商品一覧</h1>
        @else
            <h1>商品一覧</h1>
            <a href="{{ route('products.create') }}" class="add-product-button">+ 商品を追加</a>
        @endif
    </div>

    <!-- メインコンテンツ -->
    <div class="main-content">
        <!-- 左側: 検索フォーム -->
        <div class="search-section">
    <form action="{{ route('products.index') }}" method="GET" class="search-form">
    <!-- 商品名で検索 -->
    <div class="search-item">
        <input type="text" name="search" class="search-input" placeholder="商品名で検索" value="{{ request('search') }}">
    </div>
    <div class="search-item">
        <button type="submit" class="search-button">検索</button>
    </div>

    <!-- 価格順で並び替え -->
    <div class="search-item">
        <label for="sort" class="search-label">価格順で表示</label>
        <select name="sort" class="search-select" onchange="this.form.submit()">
            <option value="" class="placeholder-option" disabled selected>価格で並べ替え</option>
            <option value="asc" class="normal-option" {{ request('sort') == 'asc' ? 'selected' : '' }}>価格の安い順</option>
            <option value="desc" class="normal-option" {{ request('sort') == 'desc' ? 'selected' : '' }}>価格の高い順</option>
        </select>
    </div>
    </form>

<!-- タグ表示 -->
@if(request('sort'))
    <div class="filter-tags">
        <span class="tag">
            {{ request('sort') === 'desc' ? '価格の高い順' : '価格の安い順' }}
            <a href="{{ route('products.search', ['search' => request('search')]) }}" class="tag-remove">×</a>
        </span>
    </div>
@endif
</div>

        <!-- 商品一覧 -->
        <div class="product-list">
        @foreach ($products as $product)
            <div class="product">
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                <!-- 商品名と価格を横並びに -->
                <div class="product-info">
                    <h2>{{ $product->name }}</h2>
                    <p>¥{{ number_format($product->price) }}</p>
                </div>
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