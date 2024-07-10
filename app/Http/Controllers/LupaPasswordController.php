<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class LupaPasswordController extends Controller
{
    //
    public function index()
    {
        return view('');
    }

    public function lupapw(Request $request)
    {
        $config = [
            'protocol' => 'smtp',
            'SMTPCrypto' => 'ssl',
            'SMTPHost' => 'smtp.googlemail.com',
            'SMTPUser' => 'e.nomor252@gmail.com',
            'SMTPPass' => 'jtaq zepq nmiy iluu',
            'SMTPPort' => 465,
            'mailType' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n",
        ];

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return back()->withErrors(['email' => 'Email tidak terdaftar']);
        }
        // $existingToken = UserToken::where('email', $request->email)->first();
        // if ($existingToken) {
        //     $createdTime = Carbon::parse($existingToken->created_at);
        //     $currentTime = Carbon::now();
        //     $difference = $currentTime->diffInSeconds($createdTime);

        //     if ($difference < 86400) {
        //         return back()->withErrors(['email' => 'Kami sudah mengirimkan verifikasi, silahkan cek email Anda']);
        //     } else {
        //         $existingToken->delete();
        //     }
        // }

        $token = str()::random(64);
        $uuid = Uuid::uuid4();
        $uuidString = $uuid->toString();

//         $userToken = new UserToken([
//             'id' => $uuidString,
//             'email' => $request->email,
//             'token' => $token,
//         ]);

//         if ($user) {
//             // dd($user);
//             if ($userToken) {
//                 $createdTime = Time::parse($userToken['created_at']);
//                 $currentTime = new DateTime();
//                 $difference = $currentTime->getTimestamp() - $createdTime->getTimestamp();
//                 if ($difference < 86400) {
//                     // dd($user);
//                     return redirect()->back()->with('error', 'kami sudah mengirimkan verivikasi silahkan cek Email Anda');
//                 } else {

//                     $token = base64_encode(random_bytes(32));
//                     $uuid = Uuid::uuid4();
//                     $uuidString = $uuid->toString();

//                     $email = \Config\Services::email();
//                     $email->initialize($config);
//                     $email->setNewLine("\r\n");

//                     $email->setFrom('e.nomor252@gmail.com', 'E-Nomor Buleleng');
// // dd($userEmail);
//                     $email->setTo($userEmail);
//                     $email->setSubject('Reset password');
//                     $email->setMessage('<p style="text-align:center;">Click the button below to reset your password:</p><p style="text-align:center;">Your email: ' . $userEmail . '</p><p style="text-align:center;"><a href="' . base_url('resetpassword?&email=' . $userEmail . '&token=' . urlencode($token)) . '"><button style="background-color: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 5px; text-align: center; display: inline-block; font-size: 16px; margin: 10px auto; cursor: pointer;">Reset Password</button></a></p>');

//                     $user_token = [
//                         'id' => $uuidString,
//                         'email' => $userEmail,
//                         'token' => $token,
//                         'created_at' => Time::now(),
//                     ];

//                     if ($email->send()) {
//                         $this->userToken->insert($user_token);

//                         return redirect()->back()->with('success', 'Email Berhasil dikirim');

//                     } else {
//                         return redirect()->back()->with('error', 'tidak dapat mengrim email');

//                     }

//                 }

//             }

//             $token = base64_encode(random_bytes(32));
//             $uuid = Uuid::uuid4();
//             $uuidString = $uuid->toString();

//             $email = \Config\Services::email();
//             $email->initialize($config);
//             $email->setNewLine("\r\n");

//             $email->setFrom('e.nomor252@gmail.com', 'E-Nomor Buleleng');
//             // dd($userEmail);
//             $email->setTo($userEmail);
//             $email->setSubject('Reset password');
//             $email->setMessage('<p style="text-align:center;">Click the button below to reset your password:</p><p style="text-align:center;">Your email: ' . $userEmail . '</p><p style="text-align:center;"><a href="' . base_url('resetpassword?&email=' . $userEmail . '&token=' . urlencode($token)) . '"><button style="background-color: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 5px; text-align: center; display: inline-block; font-size: 16px; margin: 10px auto; cursor: pointer;">Reset Password</button></a></p>');

//             $user_token = [
//                 'id' => $uuidString,
//                 'email' => $userEmail,
//                 'token' => $token,
//                 'created_at' => Carbon::now(),
//             ];

//             if ($email->send()) {
//                 $this->userToken->insert($user_token);

//                 return redirect()->back()->with('success', 'Email Berhasil dikirim');

//             } else {
//                 return redirect()->back()->with('error', 'tidak dapat mengrim email');
//             }

//         } else {
//             return redirect()->back()->with('error', 'email tidak terdaftar');
//         }

    }
}