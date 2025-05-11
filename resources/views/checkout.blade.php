@extends('layouts.app')
@section('title', 'Hizmet Talebi Tamamla')

@section('content')
<div class="container py-5">
    <div class="row">
        {{-- Fatura Bilgileri --}}
        <div class="col-md-6">
            <h3 class="mb-4">🧾 Fatura Bilgileri</h3>
            <form action="{{ route('checkout.store') }}" method="POST">
                @csrf

                {{-- Email --}}
                <div class="mb-3">
                    <label for="email" class="form-label">E-posta</label>
                    <input type="email" name="email" class="form-control" required
                           value="{{ auth()->check() ? auth()->user()->email : old('email') }}">
                </div>

                {{-- İsim --}}
                <div class="mb-3">
                    <label for="name" class="form-label">Ad Soyad</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                {{-- Adres --}}
                <div class="mb-3">
                    <label for="address" class="form-label">Adres</label>
                    <textarea name="address" class="form-control" rows="2" required></textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Şehir</label>
                        <input type="text" name="city" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>İlçe / Mahalle</label>
                        <input type="text" name="province" class="form-control" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Posta Kodu</label>
                        <input type="text" name="postal_code" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Telefon</label>
                        <input type="text" name="phone" class="form-control" required>
                    </div>
                </div>

                {{-- Ödeme Bilgisi (simüle) --}}
                <h5 class="mt-4">💳 Ödeme Bilgisi (Simülasyon)</h5>
                <div class="mb-3">
                    <label>Kart Üzerindeki İsim</label>
                    <input type="text" name="name_on_card" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Kart Numarası</label>
                    <input type="text" name="credit_card" class="form-control" placeholder="XXXX XXXX XXXX XXXX" required>
                </div>

                <button type="submit" class="btn btn-success w-100">İşlemi Tamamla</button>
            </form>
        </div>

        {{-- Sipariş Özeti --}}
        <div class="col-md-6">
            <h3 class="mb-4">📋 Hizmet Özeti</h3>
            <table class="table">
                <tbody>
                    @foreach (Cart::instance('default')->content() as $item)
                        <tr>
                            <td width="80">
                                <img src="{{ productImage($item->model->image) }}" class="img-fluid rounded">
                            </td>
                            <td>
                                <strong>{{ $item->model->name }}</strong><br>
                                <small>{{ $item->model->details }}</small>
                            </td>
                            <td>{{ $item->qty }} adet</td>
                            <td class="text-end">{{ format($item->subtotal) }} ₺</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- Fiyatlar --}}
            <ul class="list-group mb-3">
                <li class="list-group-item d-flex justify-content-between">
                    <span>Ara Toplam</span>
                    <span>{{ format($subtotal) }} ₺</span>
                </li>

                @if (session()->has('coupon'))
                    <li class="list-group-item d-flex justify-content-between">
                        <span>İndirim ({{ session('coupon')['code'] }})</span>
                        <span>-{{ format($discount) }} ₺</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Yeni Ara Toplam</span>
                        <span>{{ format($newSubtotal) }} ₺</span>
                    </li>
                @endif

                <li class="list-group-item d-flex justify-content-between">
                    <span>KDV (18%)</span>
                    <span>{{ format($tax) }} ₺</span>
                </li>

                <li class="list-group-item d-flex justify-content-between fw-bold">
                    <span>Toplam</span>
                    <span>{{ format($total) }} ₺</span>
                </li>
            </ul>

            {{-- Kupon Alanı --}}
            @if (!session()->has('coupon'))
                <form action="{{ route('coupon.store') }}" method="POST" class="d-flex gap-2">
                    @csrf
                    <input type="text" name="coupon_code" class="form-control" placeholder="Kupon kodu girin">
                    <button type="submit" class="btn btn-outline-primary">Uygula</button>
                </form>
            @endif
        </div>
    </div>
</div>
@endsection
