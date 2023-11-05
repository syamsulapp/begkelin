<?php

namespace App\Http\Controllers;

use App\Models\Bengkel;
use App\Models\Booking;
use App\Models\DetailLayananBooking;
use App\Models\User;
use Egulias\EmailValidator\Result\Reason\DetailedReason;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    public function transaksi()
    {
        $item['bengkels'] = Bengkel::where('pemilik_id', Auth::id())->get();
        // dd($item);
        $bengkel_ids = $item['bengkels']->map(function ($bengkel) {
            return $bengkel->id;
        });

        $transaksi = Booking::with(['kendaraan', 'user', 'bengkel', 'layanans', 'detail_layanan_bookings'])
            ->whereIn('bengkel_id', $bengkel_ids)->get();
        return view('mitra/bengkel/transaksi', ['bookings' => $transaksi], $item);
    }

    public function edittransaksi($id)
    {
        $transaksi['bookings'] = Booking::with(['kendaraan', 'user', 'bengkel', 'layanans', 'detail_layanan_bookings'])
            ->findOrFail($id);

        //create data (add)
        return view(
            'mitra/bengkel/edittransaksi',
            $transaksi
        );
    }

    public function detailtransaksi($id)
    {
        $transaksi = Booking::with(['kendaraan', 'user', 'bengkel', 'layanans', 'detail_layanan_bookings'])
            ->findOrFail($id);

        $detail = DetailLayananBooking::with(['booking', 'layanan'])->get();

        // dd($transaksi);

        return view('mitra/bengkel/detailtransaksi', ['bookings' => $transaksi, 'detail_booking' => $detail]);
    }

    public function updatetransaksi(Request $request, $id)
    {
        $transaksi['bookings'] = Booking::with(['kendaraan', 'user', 'bengkel', 'layanans', 'detail_layanan_bookings'])
            ->findOrFail($id);

        $validated = $request->validate([
            'status' => 'required'
        ]);

        Booking::where('id', $id)->update([
            'status' => $validated['status']
        ]);

        return redirect()->back()->with('success', 'Status Berhasil Diubah!');
    }
}
