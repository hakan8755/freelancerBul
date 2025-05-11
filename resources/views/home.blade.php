@extends('layouts.app')
@section('title', 'Kullanıcı Paneli')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">👤 Hoş Geldin, {{ auth()->user()->name }}!</h2>

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <div class="row g-4">
        {{-- Profil Kartı --}}
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-header">Profil Bilgileri</div>
                <div class="card-body">
                    <p><strong>Ad Soyad:</strong> {{ auth()->user()->name }}</p>
                    <p><strong>E-posta:</strong> {{ auth()->user()->email }}</p>
                    <p><strong>Rol:</strong> {{ auth()->user()->role ?? 'Kullanıcı' }}</p>
                </div>
            </div>
        </div>

        {{-- İlan Özeti --}}
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-header">İlanlarım</div>
                <div class="card-body">
                    {{-- Bu kısmı backend'de $jobCount olarak gönderirsen daha temiz olur --}}
                    <p>Açtığınız ilan sayısı: <strong>{{ $jobCount ?? '0' }}</strong></p>
                    <a href="{{ route('jobs.create') }}" class="btn btn-primary btn-sm">Yeni İlan Oluştur</a>
                    <a href="{{ route('jobs.index') }}" class="btn btn-outline-secondary btn-sm mt-2">Tüm İlanları Gör</a>
                </div>
            </div>
        </div>

        {{-- Başvurularım --}}
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-header">Başvurularım</div>
                <div class="card-body">
                    <p>Yaptığınız başvuru sayısı: <strong>{{ $applicationCount ?? '0' }}</strong></p>
                    <a href="#" class="btn btn-outline-info btn-sm">Başvurularımı Gör</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
