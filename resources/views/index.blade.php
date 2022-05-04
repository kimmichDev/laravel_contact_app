@extends('layout')
@section('bread')
    <div class=" d-flex justify-content-between align-items-center">
        <div class="btn-group">
            <button class="btn btn-primary">
                <i class="bi bi-house-heart"></i>
            </button>
            <a href="{{ route('contact.create') }}" class="text-decoration-none btn btn-outline-primary">
                <i class="bi bi-plus-circle h3 mb-0"></i>
            </a>
        </div>
        <div class="ms-md-3">
            <a href="{{ route('showTrash') }}" class="btn btn-outline-danger my-2 p-2 p-md-3 text-decoration-none">
                <span class="p-1 p-md-2 bg-danger rounded-circle text-light me-3">
                    <i class="bi bi-trash"></i>
                </span>
                <span class="text-black"> Trash contacts</span>
            </a>
        </div>
    </div>
@endsection
@section('content')
    <div class="card shadow blur">

        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="mb-0 text-black text-nowrap">Contact List</h3>
                <x-search search="{{ $search }}" />
            </div>
        </div>

    </div>
    <div class="d-flex justify-content-between align-items-center my-2">
        <button type="submit" form="checkForm" class="btn btn-danger p-del-btn d-none animate__animated animate__fadeIn">
            <p class="mb-0 small trash-text"></p>
        </button>
    </div>
    <div class="d-none">
        <form action="{{ route('bulkDelete') }}" id="checkForm" method="POST">
            @method("delete")
            @csrf
        </form>
    </div>
    <div>
        @foreach ($contacts as $contact)
            <x-phone-card :contact="$contact" showLink="show" />
        @endforeach
    </div>
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
        let checks = document.querySelectorAll(".form-check-input");
        checks.forEach((c) => {
            c.addEventListener("change", () => {
                $(".p-del-btn").removeClass("d-none animate__fadeOut");
                $(".p-del-btn").addClass("d-inline-block animate__fadeIn");
                $('.trash-text').html(
                    `Move to trash 
                    <span class="fw-bold">${$('.checkBox:checked').length} contact${$('.checkBox:checked').length>1 ? "s" : ""}</span>
                    <i class="bi bi-trash2 ms-2 h4"></i>
                    `
                )
                if ($('.checkBox:checked').length == 0) {
                    $(".p-del-btn")
                        .removeClass("animate__fadeIn d-inline-block")
                        .addClass("animate__fadeOut d-none");
                }
            })
        })
    </script>
@endsection
