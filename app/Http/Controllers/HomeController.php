<?php

namespace App\Http\Controllers;

use App\Client;
use App\Redemption;
use App\User;
use App\Voucher;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home')
            ->with('redemption', Redemption::all()->count())
            ->with('vouchers', Voucher::all()->count())
            ->with('clients', Client::all()->count())
            ->with('users', User::all()->count());
    }
}
