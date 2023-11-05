@extends('layouts.app')

@section('title', 'Profile Transaksi')

@section('content')
    <div class="container" style="margin-bottom: 200px;">
        <div class="row">
            <div class="col">
                <div class="text-center my-5">
                    <h3 class="title">List Transaksi</h3>
                </div>
            </div>
        </div>
        <div class="row row-cols-1 row-cols-md-2 g-4">
            @if ($transaksi->isEmpty())
                <p><i class="text-warning">Ups, Kamu belum memiliki transaksi</i></p>
            @else
                @foreach ($transaksi as $item)
                    <div class="col">
                        @php
                            $total_price = 0;
                        @endphp
                        <div class="card my-3 p-5">
                            <div class="card-body">
                                <div class="">
                                    <h4 class="card-title">{{ $item->bengkel->name }}</h4>
                                </div>
                                <div>
                                    <div class="detail-booking d-flex justify-content-between align-items-center">
                                        <p style="margin: 0">ID Booking</p>
                                        <p style="margin: 0" class="fw-bold">{{ $item->id }}</p>
                                    </div>
                                    <div class="detail-booking d-flex justify-content-between align-items-center">
                                        <p style="margin: 0">Status</p>
                                        <p style="margin: 0" class="fw-bold">{{ $item->status }}</p>
                                    </div>
                                    <div class="detail-booking d-flex justify-content-between align-items-center">
                                        <p style="margin: 0">Tipe Booking</p>
                                        <p style="margin: 0" class="fw-bold">{{ $item->tipe_booking }}</p>
                                    </div>
                                    <div class="detail-booking d-flex justify-content-between align-items-center">
                                        <p style="margin: 0">Waktu Booking</p>
                                        <p style="margin: 0" class="fw-bold">{{ $item->waktu_booking }}</p>
                                    </div>
                                </div>
                                <div class="mt-5">
                                    <h5>Detail Layanan Booking</h5>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Nama Layanan</th>
                                                <th scope="col">Harga</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($detail_booking as $detail)
                                                @if ($detail->booking->id == $item->id)
                                                    <tr>
                                                        <td>
                                                            <p style="margin: 0">{{ $detail->layanan->name }}</p>
                                                        </td>
                                                        <td>
                                                            <p style="margin: 0">
                                                                Rp{{ number_format($detail->layanan->price, 0, ',', '.') }}
                                                            </p>
                                                        </td>
                                                    </tr>
                                                    @php
                                                        $total_price += $detail->layanan->price * $detail->qty;
                                                    @endphp
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="mt-5">
                                    <h5>Total: Rp{{ number_format($total_price, 0, ',', '.') }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        <div class="my-5">
            <div class="mb-1">
                {{ $transaksi->links() }}
            </div>
        </div>
    </div>
@endsection
