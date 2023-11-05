@extends('mitra.layouts.app')

@section('title', 'Bengkel | Transaksi')

@section('content')
    <div class="card" style="margin-bottom: 200px;">
        <div class="row m-4">
            <div class="col">
                <h2>Edit Transaksi</h2>
            </div>
        </div>
        <div class="row m-4">
            <div class="col">
                <form action="{{ route('updatetransaksi', ['id' => $bookings->id]) }}" method="post">
                    @method('put')
                    @csrf
                    <div class="mb-3 form">
                        <label for="status" class="form-label">Status Booking</label>
                        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
                            @foreach (App\Enums\BookingStatus::cases() as $status)
                                <option value="{{ $status->value }}">{{ $status->name }}</option>
                            @endforeach
                        </select>
                        @error('status')
                            <div class="invalid-feedback">
                                Status tidak boleh kosong
                            </div>
                        @enderror
                    </div>
                    <div class="action-user d-flex justify-content-end align-items-center">
                        <button type="submit" class="btn btn-primary mt-3">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('sweetalert::alert')
@endsection
