<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserToken;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class LupaPasswordController extends Controller
{
    //
    public function index()
    {
        //ini untuk tampilan lupa passwornya
        return view('public.lupa');
    }

    public function lupapw(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return back()->withErrors(['email' => 'Email tidak terdaftar']);
        }
        $existingToken = UserToken::where('email', $request->email)->first();
        if ($existingToken) {
            $createdTime = Carbon::parse($existingToken->created_at);
            $currentTime = Carbon::now();
            $difference = $currentTime->diffInSeconds($createdTime);

            if ($difference < 86400) {
                return back()->withErrors(['email' => 'Kami sudah mengirimkan verifikasi, silahkan cek email Anda']);
            } else {
                $existingToken->delete();
            }
        }

        $token = Str::random(64);

        $userToken = new UserToken([
            'email' => $request->email,
            'token' => $token,
        ]);
        $userToken->save();

        $resetLink = route('lupa',
            [
                'token' => $token,
                'email' => urlencode($request->email),
            ]);

        Mail::send('public.lupa', ['resetLink' => $resetLink, 'email' => $request->email], function ($message) use ($request) {
            $message->from('kosadik22@gmail.com', 'Toko Baju Tradisional');
            $message->to($request->email);
            $message->subject('Reset Password');
        });

        //     $token = base64_encode(random_bytes(32));
        //     $uuid = Uuid::uuid4();
        //     $uuidString = $uuid->toString();

        //     $email = \Config\Services::email();
        //     $email->initialize($config);
        //     $email->setNewLine("\r\n");

        //     $email->setFrom('e.nomor252@gmail.com', 'E-Nomor Buleleng');
        //     // dd($userEmail);
        //     $email->setTo($userEmail);
        //     $email->setSubject('Reset password');
        //     $email->setMessage('<p style="text-align:center;">Click the button below to reset your password:</p><p style="text-align:center;">Your email: ' . $userEmail . '</p><p style="text-align:center;"><a href="' . base_url('resetpassword?&email=' . $userEmail . '&token=' . urlencode($token)) . '"><button style="background-color: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 5px; text-align: center; display: inline-block; font-size: 16px; margin: 10px auto; cursor: pointer;">Reset Password</button></a></p>');

        //     $user_token = [
        //         'id' => $uuidString,
        //         'email' => $userEmail,
        //         'token' => $token,
        //         'created_at' => Carbon::now(),
        //     ];

        //     if ($email->send()) {
        //         $this->userToken->insert($user_token);

        //         return redirect()->back()->with('success', 'Email Berhasil dikirim');

        //     } else {
        //         return redirect()->back()->with('error', 'tidak dapat mengrim email');
        //     }

        // } else {
        //     return redirect()->back()->with('error', 'email tidak terdaftar');
        // }
return back()->with('success', 'Email Berhasil dikirim');

    }
}
