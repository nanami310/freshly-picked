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
                </div>
            <!-- 右側のカラム -->
                <div class="right-column">
                    <p>商品名 </p>
                    <input type="text" name="name" value="{{ old('name', $product->name) }}" class="form-control" placeholder="商品名を入力">
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <p>値段 </p>
                    <input type="text" name="price" value="{{ old('price', number_format($product->price, 0, '', '')) }}" class="form-control" placeholder="値段を入力">
                    @error('price')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <p>季節</p>
                    <div>
                        @php
                            $seasons = $product->season; // ここはそのまま配列と仮定
                            $availableSeasons = ['春', '夏', '秋', '冬'];
                        @endphp
                        @foreach ($availableSeasons as $season)
                        <fieldset class="checkbox-2">
                            <label >
                                <input type="checkbox" name="season[]" value="{{ $season }}"  {{ in_array($season, $seasons) ? 'checked' : '' }}>
                                {{ $season }}</label>
                                </fieldset>
                        @endforeach
                    </div>
                    @error('season')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <!-- 商品説明 -->
            <div class="description-section mt-3">
                <p>商品説明 </p>
                <textarea name="description" class="form-control2" placeholder="商品の説明を入力">{{ old('description', $product->description) }}</textarea>
                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                
                <div class="button-section mt-3">
                <a href="{{ route('products.index') }}" class="btn btn-secondary">戻る</a>
                <button type="submit" class="btn2 btn-primary">変更を保存</button>
                </form>

                <!-- 削除ボタンの追加 -->
                <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="mt-3" onsubmit="return confirm('本当に削除しますか？');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn3 btn-danger"><i class="fas fa-trash-alt"></i></button>
                </form>
                </div>

            </div>
    </div>

<script>
    document.getElementById('image').addEventListener('change', function() {
        const fileName = this.files[0] ? this.files[0].name : '';
        // 選択されたファイル名を表示する場合は以下の行を有効にしてください
        document.getElementById('fileName').textContent = fileName || '';
    });
</script>
@endsection