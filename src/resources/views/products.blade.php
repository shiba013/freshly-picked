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
                <select name="sort" id="sort" class="sort__select" onchange="this.form.submit()">
                    <option value="" style="color:#e0dfde" disable selected>価格で並べ替え</option>
                    <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>価格が高い順</option>
                    <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>価格が安い順</option>
                </select>
            </div>
        </div>
        <div class="search-form__items">
            @if(request('sort') == 'price_desc')
            <div class="sort__tag">
                <span class="sort__span">
                    高い順に表示
                    <input type="submit" value="×" class="sort__button" name="reset">
                </span>
            </div>
            @elseif(request('sort') == 'price_asc')
            <div class="sort__tag">
                <span class="sort__span">
                    安い順に表示
                    <input type="submit" value="×" class="sort__button" name="reset">
                </span>
            </div>
            @endif
        </div>
    </form>
</div>
@endsection

@section('content')
<div class="cards">
    @foreach($products as $product)
    <form action="/products/{{ $product->id }}" method="get" class="card-content" enctype="multipart/form-data">
        <div class="fruit-card">
            <button type="submit" class="fruit-card__button">
                <div class="fruit-img">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="">
                </div>
                <div class="card-group">
                    <p class="fruit-name">{{ $product->name }}</p>
                    <p class="fruit-price">¥{{ $product->price }}</p>
                </div>
            </button>
        </div>
    </form>
    @endforeach
</div>
<div class="paginate">
    {{ $products->links('vendor.pagination.bootstrap-4') }}
</div>
@endsection