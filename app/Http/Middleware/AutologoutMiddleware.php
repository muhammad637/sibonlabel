<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Session\Store;

class AutologoutMiddleware
{
    protected $session;


    // protected $timeout = 1000; //  10  = 1 menit


    // public function __construct(Store $session)
    // {
    //     $this->session = $session;
    // }

    public function handle($request, Closure $next)
    {
        // Cek apakah pengguna sudah login
        // if (Auth::check()) {
        //     // Ambil waktu terakhir aktivitas
        //     $last_activity =  session(['last_activity' => time() * 100]);
        //     // $last_activity = $this->session->get('last_activity');

        //     // Cek apakah ada waktu terakhir aktivitas
        //     if ($last_activity && time() - $last_activity > $this->timeout) {
        //         // Jika waktu terakhir aktivitas lebih dari timeout, logout pengguna
        //         Auth::logout();
        //         $request->session()->invalidate();
        //         return redirect('/login')->with('toast_success', "Anda login selama 5 menit , mohon login kembali🙏");
        //     }

        //     // Update waktu terakhir aktivitas
            // $this->session->put('last_activity', time());
        // }

        // return $next($request);
    
    }
}
