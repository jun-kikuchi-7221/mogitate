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
            <div class="image-preview-container">
                <!-- プレビュー表示エリア -->
                <div id="image-preview" class="image-preview">
                     @if(old('product_image') || $product->image)
                        <img src="{{ old('product_image') ? old('product_image') : asset('storage/' . $product->image) }}" alt="商品画像" style="width: 375px; height: 280px; object-fit: cover;">
                    @else
                        <p>ここにプレビューが表示されます</p>
                    @endif
                </div>

                <!-- ファイル選択ボタンとファイル名 -->
                <div class="file-select-row">
                    <!-- 画像を選択 -->
                    <label for="product-image" class="btn btn-primary2">ファイルを選択</label>
                    <input type="file" id="product-image" name="product_image" class="file-input" accept="image/*" style="display: none;">
                    <span id="file-name" class="file-name">
                    {{ old('product_image', $product->image ? basename($product->image) : '選択されていません') }}
                    </span>
                    <!-- 現在の画像ファイル名を保持するための hidden フィールド -->
                    <input type="hidden" name="current_image" value="{{ $product->image }}">
                </div>
                @error('product_image')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <!-- 商品情報 -->
            <div class="detail-info">
                <!-- 商品名 -->
                <div class="form-group">
                    <label for="name">商品名</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}" placeholder="商品名を入力">
                    @error('name')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                <!-- 値段 -->
                <div class="form-group">
                    <label for="price">値段</label>
                    <input type="text" id="price" name="price" value="{{ old('price', $product->price) }}" placeholder="値段を入力">
                    @error('price')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                <!-- 季節 -->
                <div class="form-group">
                    <label>季節</label>
                    <div class="season-group">
                        @foreach($allSeasons as $season)
                            <label>
                                <input type="checkbox" name="seasons[]" value="{{ $season->id }}"
                                {{ old('seasons') !== null 
                                    ? (in_array($season->id, old('seasons')) ? 'checked' : '') 
                                    : (in_array($season->id, $product->seasons->pluck('id')->toArray()) ? 'checked' : '') }}>
                                <span>{{ $season->name }}</span>
                            </label>
                        @endforeach
                    </div>
                    @error('seasons')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- 商品説明 -->
        <div class="form-group2">
            <label class="description">商品説明</label>
            <textarea id="description" name="description" placeholder="商品の説明を入力">{{ old('description', $product->description) }}</textarea>
            @error('description')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <!-- ボタンセクション -->
        <div class="form-footer">
            <div class="button-group">
                <a href="{{ route('products.index') }}" class="btn btn-secondary">戻る</a>
                <button type="submit" class="btn btn-primary">変更を保存</button>
            </div>
        </div>
    </form>

    <!-- ゴミ箱アイコン -->
    <div class="delete-group">
        <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="delete-form">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger delete-btn">
                <i class="fas fa-trash-alt"></i>
            </button>
        </form>
    </div>
</div>
@endsection



@section('scripts')
<script>
    document.getElementById('product-image').addEventListener('change', function(event) {
        const preview = document.getElementById('image-preview');
        const fileNameDisplay = document.getElementById('file-name');
        const file = event.target.files[0];

        if (file) {
            // ファイル名を更新
            fileNameDisplay.textContent = file.name;

            // プレビュー画像を更新
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.innerHTML = `
                    <img src="${e.target.result}" alt="プレビュー画像" 
                         style="width: 375px; height: 280px; object-fit: cover;">
                `;
            };
            reader.readAsDataURL(file);
        } else {
            // ファイルが選択されていない場合、既存の画像ファイル名を表示
            fileNameDisplay.textContent = '{{ $product->image ? basename($product->image) : "選択されていません" }}';
            preview.innerHTML = '<p>ここにプレビューが表示されます</p>';
        }
    });
</script>
@endsection