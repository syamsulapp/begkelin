<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\ForgotPasswords;
use App\Models\PasswordResets;
use App\Models\PemilikBengkel;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function userregister()
    {
        return view('userregister');
    }

    public function ownerregister()
    {
        return view('ownerregister');
    }

    public function douserregister(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'max:100', 'email', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'phone_number' => ['required', 'string'],
            'alamat' => ['required', 'string', 'max:100'],
        ]);

        // 
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'alamat' => $request->alamat,
            'phone_number' => $request->phone_number,
        ]);

        // 
        Auth::login($user);

        return redirect('/login');
    }

    public function doownerregister(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'max:100', 'email', 'unique:' . PemilikBengkel::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'phone_number' => ['required', 'string'],
        ]);

        // 
        $owner = PemilikBengkel::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone_number' => $request->phone_number,
        ]);

        // 
        Auth::login($owner);

        return redirect('/login');
    }

    public function doLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('web')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/');
        }

        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('adminindex');
        }

        if (Auth::guard('pemilikbengkel')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route("bengkel.index");
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('login');
    }

    public function forgotPassView(Request $request)
    {
        return view('forgotPassword');
    }

    public function forgotPassSend(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ], [
            'required' => 'email wajib di masukan',
            'email' => 'penulisan email salah',
        ]);

        try {
            #reset password akun berdasarkan akun pada roles(user, pemilik bengkel, admin) apa yang mau di reset
            if ($user = User::whereemail($request->email)->firstOrFail()) {
                $mail = $user;
            } else if ($pemilikBengkel = PemilikBengkel::whereemail($request->email)->firstOrFail()) {
                $mail = $pemilikBengkel;
            } else if ($admin = Admin::whereemail($request->email)->firstOrFail()) {
                $mail = $admin;
            }
            #generate token untuk reset password
            $url = PasswordResets::create(['email' => $mail->email, 'token' => Str::random(64)]);
            #kirim token reset password ke email bersangkutan
            Mail::to($mail->email)->send(new ForgotPasswords($mail, $this->urlForgot($url)));
            return redirect()->route('forgotPassView')->with('success', 'Berhasil, Silahkan cek email anda untuk melakukan reset password');
        } catch (Exception $error) {
            #jika email tidak ditemukan maka redirect ke halaman berikut dan kasih flash data error
            return redirect()->route('forgotPassView')->with('error', 'Email Salah Atau Email Belum Terdaftar Di Sistem');
        }
    }

    public function resetPasswordView()
    {
        return view('');
    }

    public function resetPasswordSend(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed',
        ], [
            'required' => ':attribute wajib di isi',
            'confirmed' => 'password tidak sama'
        ]);

        #execute logic reset password
    }
}
