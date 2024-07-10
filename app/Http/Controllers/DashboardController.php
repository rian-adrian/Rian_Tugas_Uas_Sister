<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
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

        return view('admin.index');
    }
}