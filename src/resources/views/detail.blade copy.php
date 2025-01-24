@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}" />
<link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inika&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="detail-container">
    <div class="product">
    <a href="{{ route('products.index') }}" class="product-link">商品一覧</a>
    <span class="product-separator">＞</span>
    <span class="product-current">{{ old('name', $product->name) }}</span>
</div>
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- 商品情報フォーム -->
    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

    <!-- 商品情報ヘッダー -->
    <div class="detail-header">
        <!-- 商品画像 -->
        <div class="image-container">
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" alt="商品画像">
            @endif


        <!-- 商品情報 -->
    <div class="detail-info">
        <!-- 商品名 -->
        <div class="form-group">
            <label for="name">商品名</label>
            <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}">
        </div>

        <!-- 値段 -->
        <div class="form-group">
            <label for="price">値段</label>
            <input type="text" id="price" name="price" value="{{ old('price', $product->price) }}">
        </div>

        <!-- 季節 -->
        <div class="form-group">
            <label>季節</label>
                <div class="season-group">
                    @foreach(['春', '夏', '秋', '冬'] as $season)
                    <label>
                        <input type="checkbox" name="seasons[]" value="{{ $season }}"
                        {{-- {{ in_array($season, old('seasons', $product->seasons ? $product->seasons->toArray() : [])) ? 'checked' : '' }}> --}}
                        {{ $product->seasons->contains('name', $season) ? 'checked' : '' }}>
                        <span>{{ $season }}</span>
                    </label>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
     <!-- ファイル選択ボタン -->
        <input type="file" id="product-image" name="product_image" class="file-input">

    <!-- 商品説明 -->
    <div class="form-group">
        <label for="description">商品説明</label>
        <textarea id="description" name="description">{{ old('description', $product->description) }}</textarea>
    </div>

    <!-- ボタンセクション -->
    <div class="form-footer">
    <!-- 戻るボタン -->
    <a href="{{ route('products.index') }}" class="btn btn-secondary">戻る</a>
    
    <!-- 変更を保存ボタン -->
    <button type="submit" class="btn btn-primary">変更を保存</button>
    
    <!-- ゴミ箱アイコン（削除ボタン） -->
    <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="delete-form">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger delete-btn">
            <i class="fas fa-trash-alt"></i>
        </button>
    </form>
</div>

@endsection