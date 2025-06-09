<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;



class IndexController extends Controller
{


    public function index(){
        
         $data = DB::table('cms_module_ntmodulis')
            ->join('vietove', 'cms_module_ntmodulis.region', '=', 'vietove.id')
            ->join('kvartalas', 'cms_module_ntmodulis.quarter', '=', 'kvartalas.id')
            ->join('miestas', 'cms_module_ntmodulis.city', '=', 'miestas.id')
            ->join('gatves', 'cms_module_ntmodulis.streets', '=', 'gatves.id')
            ->join('cms_users', 'cms_module_ntmodulis.userID', '=', 'cms_users.id')
            ->orderBy('cms_module_ntmodulis.create_date', 'desc')
            ->paginate(12);


             return view('frontend.welcome',
                compact('data')
            );

    }





}
