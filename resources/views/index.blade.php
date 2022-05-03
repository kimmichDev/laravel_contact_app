@extends('layout')
@section('bread')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('contact.index') }}">Home</a></li>
        </ol>
    </nav>
@endsection
@section('content')
    <div class="card shadow blur">
        <a href="{{ route('contact.create') }}" class="text-decoration-none">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="mb-0 text-black-50">Contact List</h3>

                    <i class="bi bi-plus-circle h3 mb-0"></i>

                </div>
            </div>
        </a>
    </div>
    @foreach ($contacts as $contact)
        <div class="card my-2 my-md-3 mx-3 shadow me-4 rounded blur contact-list">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <img src="{{ $contact->photo ? asset('storage/photo/' . $contact->photo) : asset('misc/user-default.png') }}"
                        class="index-thumbnail" alt="" />
                    <div class="d-flex justify-content-between align-items-center flex-md-row flex-column">
                        <a href="{{ route('contact.show', $contact->id) }}" class="text-decoration-none">
                            <div class="">
                                <h3 class="text-black">{{ $contact->name }}</h3>
                                <p class=" text-black">{{ $contact->phone }}</p>

                            </div>
                        </a>
                        <div class="ms-md-3">
                            <a href="tel:{{ $contact->phone }}"
                                class="btn btn-outline-success p-2 p-md-3 text-decoration-none">
                                <span class="p-1 p-md-2 bg-success rounded-circle text-light me-3">
                                    <i class="bi bi-telephone"></i>
                                </span>
                                Call Now
                            </a>
                        </div>
                    </div>
                    <div class="to-right-icons">
                        <div
                            class="mb-2 p-3 p-md-4 bg-primary border text-light d-flex justify-content-center align-items-center icon-rounded">
                            <a href="{{ route('contact.edit', $contact->id) }}">
                                <i class="bi bi-pen text-light"></i>
                            </a>
                        </div>
                        <form action="{{ route('contact.destroy', $contact->id) }}" method="POST" class="icon-rounded">
                            @method('delete')
                            @csrf
                            <button
                                class="btn btn-danger icon-rounded d-flex justify-content-center p-3 p-md-4  align-items-center">
                                <span> <i class="bi bi-trash"></i></span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
@if (session('status'))
    @section('js')
        @include('./plugin/swal')
    @endsection
@endif
@section('js')
    <script>
        ScrollReveal.reveal('.contact-list', {
            distance: '50px',
            easing: 'ease-out',
            duration: 600,
            interval: 200,
            origin: 'bottom',
            mobile: true,
            reset: true,
            scale: 0.9
        });
    </script>
@endsection
