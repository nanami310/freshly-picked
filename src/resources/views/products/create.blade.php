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
            <input type="text" name="name" class="form-control" placeholder="商品名を入力" value="{{ old('name') }}">
            @error('name')
                <div class="text-danger2">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="price" class="text-title">値段 <span class="text-danger">必須</span></label><br>
            <input type="text" name="price" class="form-control" placeholder="値段を入力" value="{{ old('price') }}">
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
                <fieldset class="checkbox-2">
                <label ><input type="checkbox" name="season[]" value="春"{{old('season')=="春" ? 'checked' : '' }} > 春</label>
                <label ><input type="checkbox" name="season[]" value="夏"{{old('season')=="夏" ? 'checked' : '' }} > 夏</label>
                <label ><input type="checkbox" name="season[]" value="秋"{{old('season')=="秋" ? 'checked' : '' }} > 秋</label>
                <label ><input type="checkbox" name="season[]" value="冬"{{old('season')=="冬" ? 'checked' : '' }} > 冬</label>
                </fieldset>
            </div>
            @error('season')
                <div class="text-danger2">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="description" class="text-title">商品説明 <span class="text-danger">必須</span></label><br>
            <textarea name="description" class="form-control3" placeholder="商品の説明を入力" value="{{ old('description') }}">{{ old('description') }}</textarea>
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