@extends('layout')
@section('bread')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('contact.index') }}">Home</a></li>
            <li class="breadcrumb-item active">Create</li>
        </ol>
    </nav>
@endsection
@section('content')
    <div class="card">
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
