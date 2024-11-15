@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
<link rel="stylesheet" href="{{ asset('css/index.css') }}">

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <div class="mb-3">
                <form method="GET" action="{{ route('products.index') }}">
                    <div class="title">商品一覧</div>
                    <input type="text" name="search" class="form-control" placeholder="商品名で検索" value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary w-100">検索</button>
                    <div class="title2">価格順で表示</div>
                    <select name="sort" class="form-control" onchange="this.form.submit()">
                        <option value="">価格で並び替え</option>
                        <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>低い順に表示</option>
                        <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>高い順に表示</option>
                    </select>
                    @if (request('sort'))
                        <a href="{{ route('products.index', ['search' => request('search'), 'sort' => null]) }}" class="btn btn-secondary">
                            {{ request('sort') == 'asc' ? '低い順に表示' : '高い順に表示' }}<span style="border: 1px solid #000; border-radius: 50%; padding: 2px 5px; margin-left: 5px;">×</span>
                        </a>
                    @endif
                </form>
            </div>
        </div>

        <div class="col-md-9">
            <div class="text-end mb-3">
                <a href="{{ route('products.create') }}" class="btn btn-success">＋商品を追加</a>
            </div>
            <div class="row">
                @foreach ($products as $product)
                    <div class="col-md-4 mb-3"> <!-- 1行に3つのカードを表示 -->
                        <div class="card">
                            <a href="{{ route('products.show', $product->id) }}" style="text-decoration: none; color: inherit;">
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="card-img-top">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $product->name }}</h5>
                                    <p class="card-text"> ¥{{ number_format($product->price) }}</p>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            {{ $products->links() }}
        </div>
    </div>
</div>

@endsection