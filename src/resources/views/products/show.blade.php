@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $product->name }}</h1>
    <p>値段: {{ $product->price }}円</p>
    <p>商品説明: {{ $product->description }}</p>
    
    <h3>季節</h3>
    @if ($product->season)
        @php
            $seasons = json_decode($product->season, true); // JSONを配列にデコード
        @endphp
        @if (is_array($seasons) && count($seasons) > 0)
            <ul>
                @foreach ($seasons as $season)
                    <li>{{ $season }}</li>
                @endforeach
            </ul>
        @else
            <p>季節情報がありません。</p>
        @endif
    @else
        <p>季節情報がありません。</p>
    @endif

    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
    <a href="{{ route('products.index') }}" class="btn btn-secondary">戻る</a>
</div>
@endsection