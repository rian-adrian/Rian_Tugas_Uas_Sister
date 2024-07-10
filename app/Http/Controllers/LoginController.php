<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function index()
    {
        if (session('user')) {
            return redirect('/');
        }
        if (Auth::check()) {
            return redirect('/');
        } else {
            return view("public.login");
        }
    }
    public function ceklogin(Request $request)
    {
        // Validate the form data
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Email harus format yang valid.',
            'password.required' => 'Password wajib diisi.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Jika berhasil login
            $request->session()->regenerate();
            return redirect('/');
        } else {
            return back()->withInput()->withErrors('Email atau password salah');
        }
    }
    public function loginAPI(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Email harus format yang valid.',
            'password.required' => 'Password wajib diisi.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $user = User::where('email', $request->email)->first();
        if ($user && password_verify($request->password, $user->password)) {
            return response()->json([
                'statusCode' => 200,
                'user' => $user,
            ], 200);
        } else {
            return response()->json(['error' => 'Email atau password salah'], 500);
        }
    }
    public function logout()
    {
        Auth::logout();
        Session::forget('user');
        return redirect('/login');
    }

    //register
    public function register()
    {
        return view("public.register");
    }
    public function registerakun(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // contoh validasi untuk gambar
        ], [
            'name.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Email harus berformat yang valid.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal harus terdiri dari 8 karakter.',
            'password.regex' => 'Password harus mengandung minimal satu huruf besar, satu huruf kecil, dan satu angka.',
            'image.required' => 'Gambar wajib diunggah.',
            'image.image' => 'File harus berupa gambar.',
            'image.mimes' => 'Format gambar yang diperbolehkan: jpeg, png, jpg, gif.',
            'image.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password')); // Enkripsi password sebelum disimpan

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $user->image = $imageName;
        }

        $user->save();

        return redirect('/login')->with('success', 'Data user berhasil terdaftar, silahkan login.');
    }
}