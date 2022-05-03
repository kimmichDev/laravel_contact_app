@extends('layout')
@section('bread')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('contact.index') }}">Home</a></li>
            <li class="breadcrumb-item active">Detail</li>
        </ol>
    </nav>
@endsection
@section('content')
    <div>
        <div class="card shadow blur">
            <div class="card-body">
                <div class="d-flex justify-content-center">
                    <div>
                        <div class="d-flex justify-content-center align-items-center">
                            <img src="{{ asset('storage/photo/' . $contact->photo) }}" class="create-thumbnail text-center"
                                alt="">
                        </div>
                        <div class="">
                            <h3 class="my-3">
                                <i class="bi bi-card-text text-primary me-3"></i>
                                {{ $contact->name }}
                            </h3>
                            <p>
                                <i class="bi bi-telephone text-success h3 me-3"></i>
                                {{ $contact->phone }}
                            </p>
                            <a href="tel:{{ $contact->phone }}" class="btn btn-outline-success p-3 text-decoration-none">
                                <span class="p-2 bg-success rounded-circle text-light me-3">
                                    <i class="bi bi-telephone"></i>
                                </span>
                                Call Now
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
