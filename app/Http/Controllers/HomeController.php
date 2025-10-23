<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use DB;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Gate;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

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


    public function fallback()
    {
        if (Auth::user())
            return view("errors.404");
        else
            return view("errors.404_guest");

    }
    public function error()
    {
        //        dd(Response::HTTP_FORBIDDEN);
        if (Response::HTTP_FORBIDDEN == 403)
            return view('errors.403');
        else
            //            return redirect('/home')
            Route::redirect('/home')
                ->withErrors(array('global' => "Please Contact with Administrator" . Response::HTTP_FORBIDDEN));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('dashboard.admin');
    }

    public function clear_all()
    {
        $exitCode = Artisan::call('config:clear');
        $exitCode = Artisan::call('cache:clear');
        $exitCode = Artisan::call('view:clear');
        $exitCode = Artisan::call('route:clear');
        echo '<script>alert("Config, Cache, View & Route clear Success")</script>';
    }
}
