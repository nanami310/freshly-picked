@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
<link rel="stylesheet" href="{{ asset('css/create.css') }}">
@section('content')
<form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="name">商品名 <span class="text-danger">必須</span></label>
        <input type="text" name="name" class="form-control" >
        @error('name')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="price">値段 <span class="text-danger">必須</span></label>
        <input type="number" name="price" class="form-control" >
        @error('price')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="image">商品画像 <span class="text-danger">必須</span></label>
        <input type="file" name="image" class="form-control" >
        @error('image')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="season">季節 <span class="text-danger">必須</span> <span style="font-size: smaller;">複数選択可</span></label>
        <div>
            <label><input type="checkbox" name="season[]" value="春"> 春</label>
            <label><input type="checkbox" name="season[]" value="夏"> 夏</label>
            <label><input type="checkbox" name="season[]" value="秋"> 秋</label>
            <label><input type="checkbox" name="season[]" value="冬"> 冬</label>
        </div>
        @error('season')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="description">商品説明 <span class="text-danger">必須</span></label>
        <textarea name="description" class="form-control" ></textarea>
        @error('description')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <button type="submit" class="btn btn-success">登録</button>
    <a href="{{ route('products.index') }}" class="btn btn-secondary">戻る</a>
</form>
@endsection