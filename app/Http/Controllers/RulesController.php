<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class RulesController extends Controller
{

    //retourne la vue rules
    
    public function index(): View {
        return view ('rules');
    }
}