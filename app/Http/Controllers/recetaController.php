<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class recetaController extends Controller
{
    public function registrar()
    {
        
        return view('registrar.registrarRecetas');
    }
}
