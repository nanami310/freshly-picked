@extends('layouts.app')

@section('content')
<form method="POST" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data">
    @csrf
    @method('POST')
    <div class="mb-3">
        <label for="name">商品名</label>
        <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
        @error('name')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="price">値段</label>
        <input type="number" name="price" class="form-control" value="{{ $product->price }}" required>
        @error('price')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="season">季節</label>
        <select name="season[]" class="form-control" multiple>
            <option value="春" {{ in_array('春', $product->season) ? 'selected' : '' }}>春</option>
            <option value="夏" {{ in_array('夏', $product->season) ? 'selected' : '' }}>夏</option>
            <option value="秋" {{ in_array('秋', $product->season) ? 'selected' : '' }}>秋</option>
            <option value="冬" {{ in_array('冬', $product->season) ? 'selected' : '' }}>冬</option>
        </select>
        @error('season')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="description">商品説明</label>
        <textarea name="description" class="form-control" required>{{ $product->description }}</textarea>
        @error('description')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="image">商品画像</label>
        <input type="file" name="image" class="form-control">
        @error('image')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <button type="submit" class="btn btn-success">変更を保存</button>
    <a href="{{ route('products.index') }}" class="btn btn-secondary">戻る</a>
</form>
@endsection