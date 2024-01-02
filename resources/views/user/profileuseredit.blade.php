@extends('layouts.app')

@section('title', 'Edit User')

@push('css')
    <style>
        .buttonBack {
            top: 150%;
            left: 55%;
        }
    </style>
@endpush

@section('content')
    <div class="profileuser">
        <div class="container">
            <div class="row px-5 gx-lg-5 d-flex justify-content-center align-items-center nama-user">
                <div class="col-lg-3">
                    <img id="preview" src="{{ asset('css/bengkels.jpg') }}" alt="your profile" class="img-fluid">
                </div>
                <div class="col-lg-4 my-3">
                    <h5>Welcome,</h5>
                    <h1>{{ $users->name }}</h1>
                </div>
            </div>
        </div>
        <div class="row px-5 gx-lg-5 d-flex justify-content-center align-items-center data-user">
            <div class="col-lg-8 ">
                <form action="{{ route('updateProfileUser', $users->id) }}" method="POST" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="form">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" value="{{ $users->name }}">
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control @error('email') is-invalid @enderror" id="email"
                            name="email" value="{{ $users->email }}">
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form">
                        <label for="phone_number" class="form-label">Phone Number</label>
                        <input type="text" class="form-control @error('phone_number') is-invalid @enderror"
                            id="phone_number" name="phone_number" value="{{ $users->phone_number }}">
                        @error('phone_number')
                            <div class="invalid-feedback">
                                {{ $mesage }}
                            </div>
                        @enderror
                    </div>
                    <div class="form">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat"
                            name="alamat" value="{{ $users->alamat }}">
                        @error('alamat')
                            <div class="invalid-feedback">
                                {{ $mesage }}
                            </div>
                        @enderror
                    </div>
                    <div class="form">
                        <label for="file" class="form-label">photo</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" id="selectImage"
                            name="image">
                        @error('image')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="action-user d-flex justify-content-end align-items-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
                <div class="buttonBack">
                    <a href="{{ route('showDetailProfileUser', Auth::user()->id) }}" class="btn btn-secondary">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('previewImg')
    <script>
        selectImage.onchange = prev => {
            preview = document.getElementById('preview');
            preview.style.display = 'block';
            const [photo] = selectImage.files
            if (photo) { //kalo upload photo maka tampilkan photo dalam bentuk previewnya
                preview.src = URL.createObjectURL(photo);
            }
        }
    </script>
@endpush
