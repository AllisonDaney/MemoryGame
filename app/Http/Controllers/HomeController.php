<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{

    //retourne la vue Home
    
    public function index(): View {
        return view ('home');
    }
}