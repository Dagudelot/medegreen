<?php

namespace App\Http\Controllers;

use App\User;

use Illuminate\Http\Request;

class WinnerController extends Controller
{
    public function index(Request $request){
        $user = User::find($request->get('user_id'));
        
        // dar puntos
        $user->puntos = $user->puntos + 50000; 
        $user->save();

        return back()->with('success', 'Ganador de la semana seleccionado correctamente.');

    }
}
