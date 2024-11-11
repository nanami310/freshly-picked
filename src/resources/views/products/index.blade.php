@extends('layouts.app')

@section('content')
<div class="mb-3">
    <form method="GET" action="{{ route('products.index') }}">
        <input type="text" name="search" class="form-control" placeholder="商品名で検索" value="{{ request('search') }}">
        <select name="sort" class="form-control">
            <option value="">並び替え</option>
            <option value="asc">価格が低い順</option>
            <option value="desc">価格が高い順</option>
        </select>
        <button type="submit" class="btn btn-primary">検索</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">×</a>
    </form>
</div>

<div class="row">
    @foreach ($products as $product)
        <div class="col-md-4">
            <div class="card">
                <img src="{{ asset($product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text">{{ $product->description }}</p>
                    <p class="card-text">価格: ¥{{ $product->price }}</p>
                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-primary">詳細</a>
                </div>
            </div>
        </div>
    @endforeach
</div>

{{ $products->links() }}

<a href="{{ route('products.create') }}" class="btn btn-success">商品を追加</a>
@endsection