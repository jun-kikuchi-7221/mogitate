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
    <h1>商品登録</h1>
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- 商品名 -->
        <div>
            <label for="name">商品名 <span class="text-danger">必須</span></label>
            <input type="text" id="name" name="name" placeholder="商品名を入力" value="{{ old('name') }}">
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- 値段 -->
        <div>
            <label for="price">値段 <span class="text-danger">必須</span></label>
            <input type="number" id="price" name="price" placeholder="値段を入力" value="{{ old('price') }}">
            @error('price')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- 季節 -->
        <div>
            <label>季節 <span class="text-danger">必須</span></label>
            @foreach(['春', '夏', '秋', '冬'] as $season)
                <label>
                    <input type="checkbox" name="season[]" value="{{ $season }}" {{ in_array($season, old('season', [])) ? 'checked' : '' }}>
                    {{ $season }}
                </label>
            @endforeach
            @error('season')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- 商品説明 -->
        <div>
            <label for="description">商品説明 <span class="text-danger">必須</span></label>
            <textarea id="description" name="description" placeholder="商品の説明を入力">{{ old('description') }}</textarea>
            @error('description')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- 商品画像 -->
        <div>
            <label for="image">商品画像 <span class="text-danger">必須</span></label>
            <input type="file" id="image" name="image">
            @error('image')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- ボタン -->
        <div>
            <button type="submit">登録</button>
            <a href="{{ route('products.index') }}">戻る</a>
        </div>
    </form>
</div>
@endsection