<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class AdminController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function __invoke()
    {

        $savivaldybe = DB::table('vietove')->get();


        return view('dashboard', 
        compact('savivaldybe'));
    }

    
}
