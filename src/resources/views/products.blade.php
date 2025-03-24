@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/products.css') }}">
@endsection

@section('title')
<div class="content-title">
    <h2 class="title__header">商品一覧</h2>
    <form action="/products/register" method="get" class="register-form">
        <input type="submit" value="+ 商品を追加" class="register__button">
    </form>
</div>
@endsection

@section('aside')
<div class="sidebar">
    <form action="/products/search" method="get" class="search-form">
        <div class="search-form__items">
            <input type="text" name="keyword" value="{{ old('keyword') }}" class="search__text" placeholder="商品名で検索">
            <input type="submit" value="検索" class="search__button">
        </div>
        <div class="search-form__items">
            <label for="sort" class="sort__label">価格順で表示</label>
            <div class="sort__group">
                <select name="sort" id="sort" class="sort__select" onchange="this.form.submit()" required>
                    <option value="" disable selected>価格で並べ替え</option>
                    <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>価格が高い順</option>
                    <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>価格が安い順</option>
                </select>
            </div>
        </div>
        <div class="search-form__items">
            <div class="sort__tag">
                <span class="sort__span">
                    @if(request('sort') == 'price_desc')
                    高い順に表示
                    @else
                    低い順に表示
                    @endif
                    <input type="submit" value="×" class="sort__button" name="reset">
                </span>
            </div>
        </div>
    </form>
</div>
@endsection

@section('content')
<div class="main">
    <form action="/products/{productId}" method="get" class="card-content">
        @foreach($products as $product)
        <div class="fruit-card">
            <button type="submit" name="id" class="fruit-card__button">
                <input type="hidden" name="id" class="fruit-card__input">
            </button>
            <div class="fruit-img">
                <img src="{{ asset('/fruits-img/kiwi.png') }}" alt="">
            </div>
            <div class="card-content">
                <p class="fruit-name">{{ $product->name }}</p>
                <p class="fruit-price">¥{{ $product->price }}</p>
            </div>
        </div>
        @endforeach
    </form>
    <div class="paginate">
        {{-- $products->links('vendor.pagination.bootstrap-4') --}}
    </div>
</div>
@endsection