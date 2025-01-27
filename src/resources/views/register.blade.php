@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}" />
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
        <div class="name-group">
            <label for="name">商品名 <span class="required-label">必須</span></label>
            {{-- <label for="name">商品名 <span class="text-danger">必須</span></label> --}}
            <input type="text" id="name" name="name" placeholder="商品名を入力" value="{{ old('name') }}">
            <div class="error-container">
                @error('name')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- 値段 -->
        <div class="price-group">
            <label for="price">値段 <span class="required-label">必須</span></label>
            <input type="text" id="price" name="price" placeholder="値段を入力" value="{{ old('price') }}">
            <!-- エラーメッセージ -->
            <div class="error-container">
                @error('price')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- 商品画像 -->
        <div class="form-group">
            <label for="image">商品画像 <span class="required-label">必須</span></label>
            <!-- プレビューエリア -->
            <div id="image-preview" class="image-preview"></div>
            <!-- ファイル選択ボタン -->
            <input class="form-control-file" type="file" id="image" name="image" accept="image/*">
            {{-- onchange="previewImage(event)"> --}}
            <div class="error-container">
                @error('image')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

        </div>

        <!-- 季節 -->
        <div class="form-group">
            <label>季節 <span class="required-label">必須</span> <span class="text-muted">複数選択可</span></label>
            <div class="season-checkbox-group">
            @foreach(['春', '夏', '秋', '冬'] as $season)
                <label class="season-label">
                    <input type="checkbox" name="season[]" value="{{ $season }}" {{ in_array($season, old('season', [])) ? 'checked' : '' }}>
                    <span class="season-circle"></span>
                    <span class="season-name">{{ $season }}</span>
                </label>
            @endforeach
            </div>
            <div class="error-container">
                @error('season')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- 商品説明 -->
        <div>
            <label for="description">商品説明 <span class="required-label">必須</span></label>
            <textarea id="description" name="description" placeholder="商品の説明を入力">{{ old('description') }}</textarea>
            <div class="error-container">
                @error('description')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- ボタン -->
        <div class="button-container">
            <button type="submit" class="register-btn">登録</button>
            <a href="{{ route('products.index') }}" class="back-btn">戻る</a>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    document.getElementById('image').addEventListener('change', function(event) {
        const file = event.target.files[0]; // 選択したファイル
        const preview = document.getElementById('image-preview'); // プレビューエリア

        // プレビューエリアをクリア
        preview.innerHTML = '';

        if (file) {
            const reader = new FileReader();

            // ファイルの読み込みが完了したらプレビューに画像を表示
            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result; // 読み込んだ画像データを設定
                img.style.maxWidth = "100%"; // プレビュー画像のサイズ調整
                img.style.height = "auto";
                preview.appendChild(img); // プレビューエリアに画像を追加
            };

            reader.readAsDataURL(file); // ファイルをデータURLとして読み込む
        } else {
            preview.innerHTML = '';
        }
    });
</script>
@endsection