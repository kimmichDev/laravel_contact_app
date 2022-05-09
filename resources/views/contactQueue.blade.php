@extends('layout')
@section('bread')
    <div class="mb-3">
        <div class="btn-group">
            <a class="btn btn-outline-primary" href="{{ route('contact.index') }}">
                <i class="bi bi-house-heart"></i>
            </a>
            <button class="btn btn-outline-danger">
                <i class="bi bi-card-list"></i>
            </button>
        </div>
    </div>
@endsection
@section('content')
    <div>
        <h3 class="card-title">Contacts in queue list</h3>
        @foreach ($contactQueues as $contactQueue)
            <div class="card shadow mb-3 blur">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="card-title">{{ $contactQueue->contact->name }}</h3>
                        <span class="bg-primary p-2 text-light rounded">
                            <i class="bi bi-cursor me-2"></i>
                            <span>{{ $contactQueue->sender->name }}</span>
                        </span>
                    </div>
                    <small class="text-black-50">{{ $contactQueue->contact->phone }}</small>
                    <div class="my-3 d-flex justify-content-start align-items-center">
                        <form class="me-2" action="{{ route('contact.accept') }}" method="post">
                            @csrf
                            <input type="hidden" name="contact_id" value="{{ $contactQueue->contact->id }}">
                            <button type="submit" class="btn btn-success text-light">
                                <i class="bi bi-check-all me-2 text-light"></i>
                                <span>Accept</span>
                            </button>
                        </form>
                        <form class="me-2" action="{{ route('contact.deny') }}" method="post">
                            @csrf
                            <input type="hidden" name="queue_id" value="{{ $contactQueue->id }}">
                            <button type="submit" class="btn btn-outline-danger">
                                <i class="bi bi-x-circle me-2"></i>
                                <span>Deny</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
@endsection

@section('js')
    @if (session('status'))
        <x-toast />
    @endif
@endsection
