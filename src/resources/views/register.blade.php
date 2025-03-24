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
    <form action="/product" method="post" class="create-form">
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
                <p class="alert--danger">
                    @error('price')
                    {{ $message }}
                    @enderror
                </p>
            </div>
        </div>

        <div class="create-form__group">
            <label for="image" class="create-form__label">
                商品画像
                <span class="create-form__span">必須</span>
            </label>
            <div class="fruit-img">
                <img src="" alt="">
            </div>
            <input type="file" name="image" id="image" class="create-form__file">
            <div class="alert">
                <p class="alert--danger">
                    @error('image')
                    {{ $message }}
                    @enderror
                </p>
            </div>
        </div>

        <div class="create-form__group">
            <label for="season_id" class="create-form__label">
                季節
                <span class="create-form__span">必須</span>
                <span class="create-form__multi">複数選択可</span>
            </label>
            <div class="season-option">
                @foreach($seasons as $season)
                <label for="season_id" class="season-option__label">
                    <input type="checkbox" name="season_id" id="season_id"
                    value="{{ old('season_id') }}" class="season-option__input">
                    <span class="season-option__span">{{ $season->name}}</span>
                </label>
                @endforeach
            </div>
            <div class="alert">
                <p class="alert--danger">
                    @error('season_id')
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
                <p class="alert--danger">
                    @error('description')
                    {{ $message }}
                    @enderror
                </p>
            </div>
        </div>

        <div class="button">
            <input type="submit" value="戻る" class="back-button" name="back">
            <input type="submit" value="登録" class="create-button" name="send">
        </div>
    </form>
</div>
@endsection