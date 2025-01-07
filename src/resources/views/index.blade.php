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
    <div class="container">
        <!-- 商品一覧タイトルと追加ボタン -->
        <div class="header-row">
            <h1>商品一覧</h1>
            <button class="add-product">+ 商品を追加</button>
        </div>

        <!-- サーチ項目と商品一覧の横並びレイアウト -->
        <div class="main-content">
            <!-- 検索フォーム -->
            <div class="search-section">
                <form class="search-form">
                    <div class="search-item">
                        <label for="search">商品名で検索</label>
                        <input type="text" id="search" placeholder="商品名を入力">
                    </div>
                    <div class="search-item">
                        <label for="price">価格順で表示</label>
                        <select id="price">
                            <option value="asc">価格の安い順</option>
                            <option value="desc">価格の高い順</option>
                        </select>
                    </div>
                    <div class="search-item">
                        <button type="submit">検索</button>
                    </div>
                </form>
            </div>

            <!-- 商品一覧 -->
            <div class="product-list">
                <div class="product">
                    <img src="/images/kiwi.jpg" alt="キウイ">
                    <h2>キウイ</h2>
                    <p>¥800</p>
                </div>
                <div class="product">
                    <img src="/images/strawberry.jpg" alt="ストロベリー">
                    <h2>ストロベリー</h2>
                    <p>¥1200</p>
                </div>
                <div class="product">
                    <img src="/images/orange.jpg" alt="オレンジ">
                    <h2>オレンジ</h2>
                    <p>¥850</p>
                </div>
                <div class="product">
                    <img src="/images/watermelon.jpg" alt="スイカ">
                    <h2>スイカ</h2>
                    <p>¥700</p>
                </div>
                <div class="product">
                    <img src="/images/peach.jpg" alt="ピーチ">
                    <h2>ピーチ</h2>
                    <p>¥1000</p>
                </div>
                <div class="product">
                    <img src="/images/muscat.jpg" alt="シャインマスカット">
                    <h2>シャインマスカット</h2>
                    <p>¥1400</p>
                </div>
            </div>
        </div>

        <!-- ページネーション -->
        <div class="pagination">
            <button>&lt;</button>
            <span>1</span>
            <span>2</span>
            <span>3</span>
            <button>&gt;</button>
        </div>
    </div>
@endsection