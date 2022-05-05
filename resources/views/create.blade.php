@extends('layout')
@section('bread')
    <div class="mb-3 d-flex justify-content-between align-items-center">
        <div class="btn-group">
            <a class="btn btn-outline-primary" href="{{ route('contact.index') }}">
                <i class="bi bi-house-heart h3 mb-0"></i>
            </a>
            <a href="{{ route('contact.create') }}" class="text-decoration-none btn btn-primary">
                <i class="bi bi-plus-circle h3 mb-0"></i>
            </a>
        </div>
    </div>
@endsection
@section('content')
    <div class="card blur shadow">
        <div class="card-body">
            <div class="my-3">
                <h3>Create Contact</h3>
            </div>
            <div class="text-center mb-3">
                <img src="{{ asset('misc/user-default.png') }}" class="create-thumbnail" alt="">
            </div>
            <form action="{{ route('contact.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-floating mb-3">
                    <input type="text" value="{{ old('name') }}" name="name"
                        class="form-control @error('name') is-invalid @enderror" id="floatingInput"
                        placeholder="name@example.com">
                    <label for="floatingInput">Name</label>
                    @error('name')
                        <small class="invalid-feedback">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <input type="number" value="{{ old('phone') }}" name="phone"
                        class="form-control @error('phone') is-invalid @enderror" id="floatingPassword"
                        placeholder="Password">
                    <label for="floatingPassword">Phone Number</label>
                    @error('phone')
                        <small class="invalid-feedback">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <input type="file" name="photo" class="form-control photo-input @error('photo') is-invalid @enderror"
                        id="">
                    @error('photo')
                        <small class="invalid-feedback">{{ $message }}</small>
                    @enderror
                </div>
                <div class="d-flex justify-content-end">
                    <button class="btn btn-primary">
                        Create Now
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('js')
    <script>
        let photoInput = document.querySelector(".photo-input");
        let img = document.querySelector("img");
        photoInput.addEventListener("change", (event) => {
            let imgFile = event.target.files[0];
            let fileReader = new FileReader();
            fileReader.onload = () => {
                img.src = fileReader.result;
            }
            fileReader.readAsDataURL(imgFile);
        });
    </script>
@endsection
