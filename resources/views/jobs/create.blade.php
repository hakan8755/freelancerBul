@extends('layouts.app')

@section('title', 'Yeni İlan Oluştur')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">📄 Yeni İlan Oluştur</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('jobs.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Başlık</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Açıklama</label>
            <textarea name="description" class="form-control" rows="4" required></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Bütçe (₺)</label>
            <input type="number" name="budget" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">İlanı Yayınla</button>
    </form>
</div>
@endsection
