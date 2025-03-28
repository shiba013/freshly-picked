@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('title')
<div class="content-title">
    <h2 class="title__header">商品登録</h2>
</div>
@endsection

@section('content')
<div class="form">
    <form action="/products" method="post" class="create-form" enctype="multipart/form-data">
        @csrf
        <div class="create-form__group">
            <label for="name" class="create-form__label">
                商品名
                <span class="create-form__span">必須</span>
            </label>
            <input type="text" name="name" id="name" class="create-form__input" placeholder="商品名を入力">
            <div class="alert">
                <p class="alert--danger">
                    @error('name')
                    {{ $message }}
                    @enderror
                </p>
            </div>
        </div>

        <div class="create-form__group">
            <label for="price" class="create-form__label">
                値段
                <span class="create-form__span">必須</span>
            </label>
            <input type="text" name="price" id="price" class="create-form__input" placeholder="値段を入力">
            <div class="alert">
                @if($errors->has('price'))
                <p class="alert--danger">
                    @foreach($errors->get('price') as $message)
                    {{ $message }}
                    @endforeach
                </p>
                @endif
            </div>
        </div>

        <div class="create-form__group">
            <label for="image" class="create-form__label">
                商品画像
                <span class="create-form__span">必須</span>
            </label>
            <div class="fruit-img">
                <img src="{{-- asset('storage/images/' . $product->image) --}}" alt="">
            </div>
            <input type="file" name="image" id="image" class="create-form__file">
            <div class="alert">
                @if($errors->has('image'))
                <p class="alert--danger">
                    @foreach($errors->get('image') as $message)
                    {{ $message }}
                    @endforeach
                </p>
                @endif
            </div>
        </div>

        <div class="create-form__group">
            <label for="" class="create-form__label">
                季節
                <span class="create-form__span">必須</span>
                <span class="create-form__multi">複数選択可</span>
            </label>
            <div class="season-option">
                @foreach($seasons as $season)
                <label for="{{ $season->id }}" class="season-option__label">
                    <input type="checkbox" name="seasons[]" id="{{ $season->id }}"
                    value="{{ $season->id }}" class="season-option__input">
                    <span class="season-option__span">{{ $season->name }}</span>
                </label>
                @endforeach
            </div>
            <div class="alert">
                <p class="alert--danger">
                    @error('seasons')
                    {{ $message }}
                    @enderror
                </p>
            </div>
        </div>

        <div class="create-form__group">
            <label for="description" class="create-form__label">
                商品説明
                <span class="create-form__span">必須</span>
            </label>
            <textarea name="description" id="description" cols="100" rows="10" class="create-form__textarea" placeholder="商品の説明を入力"></textarea>
            <div class="alert">
                @if($errors->has('description'))
                <p class="alert--danger">
                    @foreach($errors->get('description') as $message)
                    {{ $message }}
                    @endforeach
                </p>
                @endif
            </div>
        </div>

        <div class="button">
            <input type="submit" value="登録" class="create-button">
        </div>
    </form>

    <form action="/products" method="get" class="back-form">
        <button type="submit" class="button back-button">戻る</button>
    </form>
</div>
@endsection