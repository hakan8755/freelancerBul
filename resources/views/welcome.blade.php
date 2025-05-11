@extends('layouts.app')
@section('title', 'Anasayfa - Freelancer Hizmet Platformu')

@push('styles')
<style>
    .hero-section {
        padding: 80px 0;
        background: linear-gradient(135deg, #f8f9fa, #e9ecef);
        text-align: center;
    }

    .hero-section h1 {
        font-size: 2.5rem;
        font-weight: 700;
    }

    .hero-section p {
        font-size: 1.2rem;
        color: #6c757d;
    }

    .job-card {
        transition: 0.3s;
    }

    .job-card:hover {
        transform: scale(1.02);
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    }
</style>
@endpush

@section('content')
<div class="hero-section">
    <div class="container">
        <h1>Freelancer Hizmet Alım Platformu</h1>
        <p>Uzmanlarla kolayca buluş, hizmetini hemen al veya ilan ver.</p>
        <div class="mt-4">
            <a href="{{ route('jobs.index') }}" class="btn btn-primary btn-lg me-2">İlanlara Göz At</a>
            <a href="{{ route('jobs.create') }}" class="btn btn-outline-dark btn-lg">İlan Oluştur</a>
        </div>
    </div>
</div>

<div class="container py-5">
    <h3 class="mb-4"><i class="bi bi-pin-angle-fill text-danger"></i> Son Eklenen İlanlar</h3>

    <div class="row">
        @forelse ($jobs as $job)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card job-card h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ $job->title }}</h5>
                        <p class="card-text">{{ Str::limit($job->description, 100) }}</p>
                        <p class="text-muted mb-1"><strong>Bütçe:</strong> {{ $job->budget ? $job->budget . ' ₺' : 'Belirtilmedi' }}</p>

                        @if ($job->user)
                            <p class="text-muted mb-0" style="font-size: 0.85rem">
                                <strong>Oluşturan:</strong> {{ $job->user->name }}<br>
                                <small>{{ $job->user->email }}</small>
                            </p>
                        @endif

                        <a href="{{ route('jobs.show', $job) }}" class="btn btn-sm btn-outline-primary mt-2">Detay</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">Henüz ilan bulunmamaktadır.</div>
            </div>
        @endforelse
    </div>

    <div class="text-center">
        <a href="{{ route('jobs.index') }}" class="btn btn-outline-dark mt-3">Tüm İlanları Gör</a>
    </div>
</div>
@endsection
