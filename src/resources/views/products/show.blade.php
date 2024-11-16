@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
<link rel="stylesheet" href="{{ asset('css/show.css') }}">


@section('content')
<form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('products.index') }}">商品一覧</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
            </ol>
        </nav>
        <div class="content-layout">
            <!-- 左側のカラム -->
                <div class="left-column">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid mb-3">
    
                    <p>
                        <input type="file" name="image" id="image">
                    </p>
                    @error('image')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
    
                    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                </div>
            <!-- 右側のカラム -->
                <div class="right-column">
                    <p>商品名: </p>
                    <input type="text" name="name" value="{{ old('name', $product->name) }}" class="form-control">
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <p>値段: </p>
                    <input type="number" name="price" value="{{ old('price', $product->price) }}" class="form-control">円
                    @error('price')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <p>季節:</p>
                    <div>
                        @php
                            $seasons = $product->season; // ここはそのまま配列と仮定
                            $availableSeasons = ['春', '夏', '秋', '冬'];
                        @endphp
                        @foreach ($availableSeasons as $season)
                            <label>
                                <input type="checkbox" name="season[]" value="{{ $season }}" {{ in_array($season, $seasons) ? 'checked' : '' }}>
                                {{ $season }}
                            </label>
                        @endforeach
                    </div>
                    @error('season')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <!-- 商品説明 -->
            <div class="description-section mt-3">
                <p>商品説明: </p>
                <textarea name="description" class="form-control">{{ old('description', $product->description) }}</textarea>
                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                
                <div class="button-section mt-3">
                <button type="submit" class="btn btn-primary">変更を保存</button>
                </form>
                <a href="{{ route('products.index') }}" class="btn btn-secondary">戻る</a>

                <!-- 削除ボタンの追加 -->
                <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="mt-3" onsubmit="return confirm('本当に削除しますか？');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">削除</button>
                </form>
                </div>

            </div>
    </div>

<script>
    document.getElementById('imageInput').addEventListener('change', function() {
        const fileName = this.files[0] ? this.files[0].name : '';
        document.getElementById('fileName').textContent = fileName ? `選択されたファイル: ${fileName}` : '';
    });
</script>
@endsection