<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index()
    {
        return view('front.home');
    }

    public function lapanganIndex()
    {
        return view('front.lapangan.index');
    }

    public function lapanganShow($id)
    {
        return view('front.lapangan.show');
    }

    public function bookingCreate()
    {
        return view('front.booking.create');
    }

    public function bookingPayment()
    {
        return view('front.booking.payment');
    }

    public function bookingRiwayat()
    {
        return view('front.booking.riwayat');
    }

    public function profile()
    {
        return view('front.profile.index');
    }

    public function login()
    {
        return view('front.auth.login');
    }

    public function register()
    {
        return view('front.auth.register');
    }

    public function support()
    {
        return view('front.support');
    }
}
