<?php

namespace App\Http\Controllers;

use App\Models\Bengkel;
use App\Models\Booking;
use App\Models\Kendaraan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $bengkel = Bengkel::where('name', 'LIKE', '%' . $keyword . '%')
            ->orWhere('alamat', $keyword)->paginate(10);
        return view('user/servicepage', ['bengkels' => $bengkel]);
    }

    public function detailBengkel($id)
    {
        $bengkel['bengkels'] = Bengkel::with(['layanans', 'jadwals'])
            ->findOrFail($id);
        return view('user/detailbengkelpage', ['bengkels' => $bengkel]);
    }

    public function bookingPage($id)
    {
        $bengkel['bengkels'] = Bengkel::with(['layanans'])
            ->findOrFail($id);

        $user = Auth::user();
        $idUser = $user->id;
        $kendaraan = Kendaraan::where('user_id', $idUser)->get();

        return view('user/pemesananpage', ['bengkels' => $bengkel, 'user' => $user, 'id_bengkel' => $id, 'kendaraans' => $kendaraan]);
    }
}
