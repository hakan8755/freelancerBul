@extends('layouts.app')
@section('title', 'Sepetim')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">📦 Sepetiniz</h2>

    @if (Cart::instance('default')->count() > 0)
        <p class="text-muted">{{ Cart::instance('default')->count() }} ürün bulundu.</p>

        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>Ürün</th>
                    <th>Detay</th>
                    <th>Miktar</th>
                    <th>Tutar</th>
                    <th>İşlem</th>
                </tr>
            </thead>
            <tbody>
                @foreach (Cart::instance('default')->content() as $item)
                    <tr>
                        <td width="120">
                            <a href="{{ route('shop.show', $item->model->slug) }}">
                                <img src="{{ productImage($item->model->image) }}" class="img-fluid" alt="{{ $item->model->name }}">
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('shop.show', $item->model->slug) }}" class="text-decoration-none">
                                <strong>{{ $item->model->name }}</strong><br>
                                <small>{{ $item->model->details }}</small>
                            </a>
                        </td>
                        <td>
                            <select class="form-select quantity" data-id="{{ $item->rowId }}" data-productQuantity="{{ $item->model->quantity }}">
                                @for ($i = 1; $i <= 10; $i++)
                                    <option value="{{ $i }}" {{ $item->qty == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                        </td>
                        <td>{{ format($item->subtotal) }} ₺</td>
                        <td>
                            <form action="{{ route('cart.destroy', [$item->rowId, 'default']) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger">Sil</button>
                            </form>
                            <form action="{{ route('cart.save-later', $item->rowId) }}" method="POST" class="d-inline">
                                @csrf
                                <button class="btn btn-sm btn-outline-secondary">Daha sonra</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="row justify-content-end">
            <div class="col-md-4">
                <ul class="list-group mb-4">
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Ara Toplam</span>
                        <span>{{ format(Cart::subtotal()) }} ₺</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>KDV (18%)</span>
                        <span>{{ format(Cart::tax()) }} ₺</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between fw-bold">
                        <span>Toplam</span>
                        <span>{{ format(Cart::total()) }} ₺</span>
                    </li>
                </ul>
                <a href="{{ route('checkout.index') }}" class="btn btn-success w-100">Siparişi Tamamla</a>
                <a href="{{ route('shop.index') }}" class="btn btn-link w-100 mt-2">Alışverişe Devam Et</a>
            </div>
        </div>

    @else
        <div class="alert alert-info text-center">
            Sepetinizde ürün bulunmamaktadır. <br>
            <a href="{{ route('shop.index') }}" class="btn btn-outline-primary mt-2">Alışverişe Başla</a>
        </div>
    @endif

    {{-- Kaydedilenler --}}
    @if (Cart::instance('saveForLater')->count() > 0)
        <hr>
        <h4>🔖 Daha Sonra Alınacaklar</h4>
        <table class="table">
            <tbody>
                @foreach (Cart::instance('saveForLater')->content() as $item)
                    <tr>
                        <td width="80">
                            <img src="{{ productImage($item->model->image) }}" class="img-fluid">
                        </td>
                        <td>
                            <strong>{{ $item->model->name }}</strong>
                            <br>
                            <small>{{ $item->model->details }}</small>
                        </td>
                        <td>{{ format($item->model->price) }} ₺</td>
                        <td>
                            <form action="{{ route('cart.destroy', [$item->rowId, 'saveForLater']) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm">Sil</button>
                            </form>
                            <form action="{{ route('cart.add-to-cart', $item->rowId) }}" method="POST" class="d-inline">
                                @csrf
                                <button class="btn btn-primary btn-sm">Sepete Ekle</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection

@section('scripts')
<script>
    document.querySelectorAll('.quantity').forEach(select => {
        select.addEventListener('change', function () {
            const id = this.dataset.id;
            const productQuantity = this.dataset.productquantity;

            axios.patch(`/cart/${id}`, {
                quantity: this.value,
                productQuantity: productQuantity
            }).then(() => {
                location.reload();
            }).catch(() => {
                location.reload();
            });
        });
    });
</script>
@endsection
