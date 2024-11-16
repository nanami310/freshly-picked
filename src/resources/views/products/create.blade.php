@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
<link rel="stylesheet" href="{{ asset('css/create.css') }}">

@section('content')
<div class="container">
    <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data" class="text-left">
        <div class="title">商品登録</div>
        @csrf
        <div class="mb-3">
            <label for="name" class="text-title">商品名 <span class="text-danger">必須</span></label><br>
            <input type="text" name="name" class="form-control" placeholder="商品名を入力">
            @error('name')
                <div class="text-danger2">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="price" class="text-title">値段 <span class="text-danger">必須</span></label><br>
            <input type="number" name="price" class="form-control" placeholder="値段を入力">
            @error('price')
                <div class="text-danger2">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="image" class="text-title">商品画像 <span class="text-danger">必須</span></label><br>
            <input type="file" name="image" class="form-control2" >
            @error('image')
                <div class="text-danger2">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="season" class="text-title">季節 <span class="text-danger">必須</span> <span style="font-size: smaller;" class="text-danger2">複数選択可</span></label><br>
            <div>
                <label><input type="checkbox" name="season[]" value="春"> 春</label>
                <label><input type="checkbox" name="season[]" value="夏"> 夏</label>
                <label><input type="checkbox" name="season[]" value="秋"> 秋</label>
                <label><input type="checkbox" name="season[]" value="冬"> 冬</label>
            </div>
            @error('season')
                <div class="text-danger2">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="description" class="text-title">商品説明 <span class="text-danger">必須</span></label><br>
            <textarea name="description" class="form-control3" placeholder="商品の説明を入力"></textarea>
            @error('description')
                <div class="text-danger2">{{ $message }}</div>
            @enderror
        </div>
        <div class="text-center">
            <a href="{{ route('products.index') }}" class="btn btn-secondary">戻る</a>
            <button type="submit" class="btn2 btn-success">登録</button>
        </div>
    </form>
</div>
@endsection