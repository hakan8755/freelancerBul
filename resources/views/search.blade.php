@extends('layouts.app')
@section('title', 'Arama Sonuçları')

@section('content')
<div class="container py-4">
    <h4 class="mb-4">
        "{{ $query }}" için <strong>{{ $products->count() }}</strong> sonuç bulundu.
        (Toplam: {{ $products->total() }})
    </h4>

    @if ($products->total() == 0)
        <div class="alert alert-warning">
            Aramanıza uygun ilan bulunamadı.
        </div>
    @else
        <div class="row g-4">
            @foreach ($products as $product)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm">
                        <img src="{{ productImage($product->image) }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text text-muted">{{ $product->details }}</p>
                            <p class="card-text">
                                {{ Str::limit(strip_tags($product->description), 100) }}
                            </p>
                            <p class="fw-bold text-danger">
                                {{ $product->price ? format($product->price) . ' ₺' : 'Fiyat belirtilmemiş' }}
                            </p>
                            <a href="{{ route('shop.show', $product->slug) }}" class="btn btn-outline-primary btn-sm">Detay</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-4">
            {{ $products->appends(['query' => request('query')])->links() }}
        </div>
    @endif
</div>
@endsection
