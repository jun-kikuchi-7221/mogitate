@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}" />
<link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inika&display=swap" rel="stylesheet">
@endsection

@section('title', '商品一覧')

@section('content')
<section class="container">
    <div class="sidebar">
        <h2>商品一覧</h2>
        <form>
            <input type="text" name="search" placeholder="商品名で検索" value="{{ request('search') }}">
            <button type="submit">検索</button>
        </form>
        <div class="sort">
            <label for="sort">価格順で表示</label>
            <select name="sort" id="sort" onchange="this.form.submit()">
                <option value="asc" {{ request('sort') === 'asc' ? 'selected' : '' }}>昇順</option>
                <option value="desc" {{ request('sort') === 'desc' ? 'selected' : '' }}>降順</option>
            </select>
        </div>
    </div>

    <div class="product-list">
        @foreach ($products as $product)
            <div class="product-card">
                <img src="{{ asset('storage/images/kiwi.png' . $product->image) }}" alt="{{ $product->name }}">
                <h3>{{ $product->name }}</h3>
                <p>¥{{ number_format($product->price) }}</p>
            </div>
        @endforeach
    </div>

    <nav class="pagination">
        {{ $products->links() }}
    </nav>
</section>
@endsection
