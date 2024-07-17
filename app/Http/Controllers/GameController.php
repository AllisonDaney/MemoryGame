<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class GameController extends Controller
{

    //retourne la vue game
    
    public function index(): View {
        return view ('game');
    }
}