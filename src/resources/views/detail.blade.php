@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('title')
<div class="content-title">
    <p class="title__header">
        <span class="title__header-span">商品一覧</span>
        > {{ $product->name }}
    </p>
</div>
@endsection

@section('content')
<div class="fruit-content">
    <form action="/products/{{ $product->id }}/update" method="post" class="edit-form" enctype="multipart/form-data">
        @method('patch')
        @csrf
        <div class="group">
            <div class="fruit-card">
                <div class="alert">
                    <p class="alert--danger">
                    @error('image')
                    {{ $message }}
                    @enderror
                    </p>
                </div>
                <div class="fruit-img">
                    <img src="{{ asset('/fruits-img/$product->image') }}" alt="">
                </div>
                <div class="card-content">
                    <input type="file" name="image" class="file__input">
                </div>
            </div>

            <div class="fruit-group">
                <div class="fruit-items">
                    <label for="name" class="fruit-items__label">商品名</label>
                    <input type="text" name="name" id="name" value="{{ $product->name }}"
                    class="fruit-items__input" placeholder="商品名を入力">
                    <div class="alert">
                        <p class="alert--danger">
                            @error('name')
                            {{ $message }}
                            @enderror
                        </p>
                    </div>
                </div>

                <div class="fruit-items">
                    <label for="price" class="fruit-items__label">価格</label>
                    <input type="text" name="price" id="price" value="{{ $product->price }}"
                    class="fruit-items__input" placeholder="値段を入力">
                    <div class="alert">
                        <p class="alert--danger">
                            @error('price')
                            {{ $message }}
                            @enderror
                        </p>
                    </div>
                </div>

                <div class="fruit-items">
                    <label for="season_id" class="fruit-items__label">季節</label>
                        <div class="season-inputs">
                            <div class="season-option">
                                @foreach($seasons as $season)
                                <label for="season_{{ $season->id }}" class="season-option__label">
                                    <input type="checkbox" name="seasons[]" id="season_{{ $season->id }}"
                                    value="{{ $season->id }}" class="season-option__input"
                                    {{ in_array($season->id, $seasonIds) ? 'checked' : '' }}>
                                    <span class="season-option__span">{{ $season->name }}</span>
                                </label>
                                @endforeach
                            </div>
                        </div>
                        <div class="alert">
                            <p class="alert--danger">
                                @error('seasons')
                                {{ $message }}
                                @enderror
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="fruit-items">
            <label for="description" class="fruit-items__label">商品説明</label>
            <textarea name="description" cols="100" rows="10" class="fruit-items__textarea"
            placeholder="商品の説明を入力">{{ $product->description }}</textarea>
            <div class="alert">
                <p class="alert--danger">
                    @error('description')
                    {{ $message }}
                    @enderror
                </p>
            </div>
        </div>

        <div class="button">
            <input type="submit" value="変更を保存" class="update-button">
        </div>
    </form>

    <form action="/products" method="get" class="back-form">
        <button type="submit" class="button back-button">戻る</button>
    </form>

    <form action="/products/{{ $product->id }}/delete" method="post" class="delete">
        @method('delete')
        @csrf
        <input type="hidden" name="id" value="{{ $product->id }}">
        <button type="submit" class="button delete-button">
            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M24 9.33325H22.6667V7.99992C22.6667 6.52792 21.472 5.33325 20 5.33325H10.6667C9.19471 5.33325 8.00004 6.52792 8.00004 7.99992V9.33325H6.66671C5.93071 9.33325 5.33337 9.93058 5.33337 10.6666C5.33337 11.4026 5.93071 11.9999 6.66671 11.9999V22.6666C6.66671 25.6079 9.05871 27.9999 12 27.9999H18.6667C21.608 27.9999 24 25.6079 24 22.6666V11.9999C24.736 11.9999 25.3334 11.4026 25.3334 10.6666C25.3334 9.93058 24.736 9.33325 24 9.33325ZM10.6667 7.99992H20V9.33325H10.6667V7.99992ZM21.3334 22.6666C21.3334 24.1386 20.1387 25.3333 18.6667 25.3333H12C10.528 25.3333 9.33337 24.1386 9.33337 22.6666V11.9999H21.3334V22.6666ZM11.3334 13.9999C10.9667 13.9999 10.6667 14.2999 10.6667 14.6666V22.6666C10.6667 23.0333 10.9667 23.3333 11.3334 23.3333C11.7 23.3333 12 23.0333 12 22.6666V14.6666C12 14.2999 11.7 13.9999 11.3334 13.9999ZM14 13.9999C13.6334 13.9999 13.3334 14.2999 13.3334 14.6666V22.6666C13.3334 23.0333 13.6334 23.3333 14 23.3333C14.3667 23.3333 14.6667 23.0333 14.6667 22.6666V14.6666C14.6667 14.2999 14.3667 13.9999 14 13.9999ZM16.6667 13.9999C16.3 13.9999 16 14.2999 16 14.6666V22.6666C16 23.0333 16.3 23.3333 16.6667 23.3333C17.0334 23.3333 17.3334 23.0333 17.3334 22.6666V14.6666C17.3334 14.2999 17.0334 13.9999 16.6667 13.9999ZM19.3334 13.9999C18.9667 13.9999 18.6667 14.2999 18.6667 14.6666V22.6666C18.6667 23.0333 18.9667 23.3333 19.3334 23.3333C19.7 23.3333 20 23.0333 20 22.6666V14.6666C20 14.2999 19.7 13.9999 19.3334 13.9999Z" fill="#FD0707"/>
            </svg>
        </button>
    </form>
</div>
@endsection