@extends('layouts.app')
@section('title', 'İlanlar')

@section('content')
<div class="container py-4">
    <div class="row">
        {{-- Filtre Alanı --}}
        <div class="col-md-3 mb-4">
            <div class="card">
                <div class="card-header bg-light">
                    <strong>Kategorilere Göre</strong>
                </div>
                <ul class="list-group list-group-flush">
                    @foreach ($categories as $category)
                        <li class="list-group-item">
                            <a href="{{ route('shop.index', ['category' => $category->slug]) }}"
                               class="{{ $category->name == $categoryName ? 'fw-bold text-primary' : '' }}">
                                {{ $category->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>

                <div class="card-header bg-light mt-3">
                    <strong>Etiketler</strong>
                </div>
                <ul class="list-group list-group-flush">
                    @foreach ($tags as $tag)
                        <li class="list-group-item">
                            <a href="{{ route('shop.index', ['tag' => $tag->slug]) }}"
                               class="{{ $tag->name == $tagName ? 'fw-bold text-primary' : '' }}">
                                {{ $tag->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        {{-- İlanlar Alanı --}}
        <div class="col-md-9">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="mb-0">{{ $categoryName }}</h4>
                <div class="d-flex gap-2">
                    <a href="{{ route('shop.index', ['category'=> request()->category, 'tag'=> request()->tag, 'sort' => 'low_high']) }}"
                       class="btn btn-sm {{ request()->sort == 'low_high' ? 'btn-primary' : 'btn-outline-secondary' }}">
                        Artan Fiyat
                    </a>
                    <a href="{{ route('shop.index', ['category'=> request()->category, 'tag'=> request()->tag, 'sort' => 'high_low']) }}"
                       class="btn btn-sm {{ request()->sort == 'high_low' ? 'btn-primary' : 'btn-outline-secondary' }}">
                        Azalan Fiyat
                    </a>
                </div>
            </div>

            {{-- İlan Kartları --}}
            <div class="row g-4">
                @foreach ($products as $product)
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 shadow-sm">
                            <a href="{{ route('shop.show', $product->slug) }}">
                                <img src="{{ productImage($product->image) }}" class="card-img-top" style="height:200px; object-fit:cover">
                            </a>
                            <div class="card-body">
                                <h5 class="card-title">
                                    <a href="{{ route('shop.show', $product->slug) }}" class="text-dark text-decoration-none">
                                        {{ $product->name }}
                                    </a>
                                </h5>
                                <p class="text-muted mb-1">{{ $product->details }}</p>
                                <p class="text-danger fw-bold">
                                    {{ $product->price ? format($product->price) . ' ₺' : 'Fiyat belirtilmedi' }}
                                </p>
                                <a href="{{ route('shop.show', $product->slug) }}" class="btn btn-sm btn-outline-primary">Detay</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Sayfalama --}}
            <div class="mt-4">
                {{ $products->appends(request()->input())->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
