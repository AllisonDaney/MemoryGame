<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ScoreController extends Controller
{

    public function store(Request $request) {

   // Se connecter à MongoDB et sélectionner la collection 'scores'
      $collection = DB::connection('mongodb')
            ->collection('scores')
            ->where('pseudo', $request->pseudo);


      // Vérifier si un document avec le pseudo existe déjà
      if ($collection->first()) {
        $collection = $collection->increment('points', $request->points); //S'il existe on incrémente
      } else {
        // Si le document n'existe pas, insérer 
        $collection = $collection->update(
          [
              'pseudo' => $request->pseudo,
              'points' => $request->points,
          ],
          ['upsert' => true],
        );
      }
    }
}