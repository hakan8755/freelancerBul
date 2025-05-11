@extends('layouts.app')
@section('title', $product->name)

@section('content')
<div class="container py-5">
    <div class="row g-4">
        {{-- Sol Kısım: Görsel --}}
        <div class="col-md-5">
            <div class="border rounded shadow-sm">
                <img src="{{ productImage($product->image) }}" class="img-fluid w-100" id="current-image">
            </div>

            {{-- Thumbnail Galeri --}}
            @if ($images && count($images) > 0)
                <div class="d-flex gap-2 mt-3 flex-wrap">
                    <img src="{{ productImage($product->image) }}" class="img-thumbnail active image-thumbnail" width="80">
                    @foreach ($images as $image)
                        <img src="{{ productImage($image) }}" class="img-thumbnail image-thumbnail" width="80">
                    @endforeach
                </div>
            @endif
        </div>

        {{-- Sağ Kısım: Ürün Bilgileri --}}
        <div class="col-md-7">
            <h2 class="mb-2">{{ $product->name }}</h2>
            <span class="badge bg-success mb-2">{{ $stockLevel }}</span>
            <p class="text-muted">{{ $product->details }}</p>

            <h4 class="text-danger mb-3">
                {{ $product->price ? format($product->price) . ' ₺' : 'Fiyat belirtilmedi' }}
            </h4>

            <div class="mb-3">
                <h5>Açıklama</h5>
                <div class="border rounded p-3 bg-light">
                    {!! $product->description !!}
                </div>
            </div>

            @if ($product->quantity > 0)
                <form action="{{ route('cart.store') }}" method="POST" class="mt-4">
                    @csrf
                    <input type="hidden" name="id" value="{{ $product->id }}">
                    <input type="hidden" name="name" value="{{ $product->name }}">
                    <input type="hidden" name="price" value="{{ $product->price }}">
                    <button type="submit" class="btn btn-primary w-100">
                        Başvur / Hizmeti Talep Et
                    </button>
                </form>
            @else
                <div class="alert alert-warning mt-4">
                    Bu hizmet şu anda alınamaz.
                </div>
            @endif
        </div>
    </div>
</div>

@include('partials.might-like')
@endsection

@section('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const currentImage = document.getElementById('current-image');
        const thumbnails = document.querySelectorAll('.image-thumbnail');

        thumbnails.forEach(thumbnail => {
            thumbnail.addEventListener('click', function () {
                thumbnails.forEach(t => t.classList.remove('active'));
                this.classList.add('active');

                if (this.src !== currentImage.src) {
                    currentImage.style.opacity = 0;
                    setTimeout(() => {
                        currentImage.src = this.src;
                        currentImage.style.opacity = 1;
                    }, 300);
                }
            });
        });
    });
</script>
@endsection
