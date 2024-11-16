@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
<link rel="stylesheet" href="{{ asset('css/index.css') }}">

@section('content')

<div class="container-fluid">
    <div class="left-column">
        <form method="GET" action="{{ route('products.index') }}">
            <div class="title">商品一覧</div>
            <input type="text" name="search" class="form-control mb-2 " placeholder="商品名で検索" value="{{ request('search') }}">
            <div class="input-group mb-2">
                <button type="submit" class="btn btn-primary w-100">検索</button>
            </div>
            <div class="title2">価格順で表示</div>
            <select name="sort" class="form-control2 mb-2" onchange="this.form.submit()">
                <option value="">価格で並び替え</option>
                <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>低い順に表示</option>
                <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>高い順に表示</option>
            </select>
            @if (request('sort'))
                <div class="sort-info mb-2">
                    <a href="{{ route('products.index', ['search' => request('search'), 'sort' => null]) }}" class="btn2 btn-secondary">
                        {{ request('sort') == 'asc' ? '低い順に表示' : '高い順に表示' }}<span style="border-radius: 50%">×</span>
                    </a>
                </div>
            @endif
            <hr class="sort-separator"> <!-- 横線を追加 -->
        </form>
    </div>

    <div class="right-column">
    <div class="text-end mb-3">
        <a href="{{ route('products.create') }}" class="btn3 btn-success">＋商品を追加</a>
    </div>

    <div class="row">
        @foreach ($products as $product)
            <div class="col-md-4 mb-3"> 
                <div class="card">
                    <a href="{{ route('products.show', $product->id) }}" style="text-decoration: none; color: inherit;">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">¥{{ number_format($product->price) }}</p>
                        </div>
                    </a>
                </div>
            </div>
        @endforeach
    </div>

    <ul class="pagination">
        <li class="prev"><a href="{{ $products->previousPageUrl() }}">＜</a></li>
        @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
            <li>
                <a href="{{ $url }}">{{ $page }}</a>
            </li>
        @endforeach
        <li class="next"><a href="{{ $products->nextPageUrl() }}">＞</a></li>
    </ul>
</div>
</div>



@endsection