@extends('layouts.app')

@section('content')
<form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="name">商品名</label>
        <input type="text" name="name" class="form-control" required>
        @error('name')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="price">値段</label>
        <input type="number" name="price" class="form-control" required>
        @error('price')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="season">季節</label>
        <select name="season[]" class="form-control" multiple>
            <option value="春">春</option>
            <option value="夏">夏</option>
            <option value="秋">秋</option>
            <option value="冬">冬</option>
        </select>
        @error('season')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="description">商品説明</label>
        <textarea name="description" class="form-control" required></textarea>
        @error('description')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="image">商品画像</label>
        <input type="file" name="image" class="form-control" required>
        @error('image')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <button type="submit" class="btn btn-success">登録</button>
    <a href="{{ route('products.index') }}" class="btn btn-secondary">戻る</a>
</form>
@endsection