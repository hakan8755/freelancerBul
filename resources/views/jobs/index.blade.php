@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tüm İlanlar</h1>
    <div class="row">
        @foreach ($jobs as $job)
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5>{{ $job->title }}</h5>
                        <p>{{ Str::limit($job->description, 100) }}</p>
                        <a href="{{ route('jobs.show', $job) }}" class="btn btn-primary">Detay</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    {{ $jobs->links() }}
</div>
@endsection
