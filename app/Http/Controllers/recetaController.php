<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Receta;

class recetaController extends Controller
{
    public function index()
    {
        
        return view('registrar.registrarRecetas');
    }
    public function registrar(Request $request)
    {
        
        if($request->hasFile('imagen')){
            //
            $validatedData = $request->validate([
             'imagen' => 'required|mimes:jpeg,png,bmp,jpg',
            ]);
             // 
             
            $file = $request->file('imagen');
            $name = time().$file->getClientOriginalName();
            $file->move(public_path().'/images/',$name);

        }
        $receta = new Receta();
        $receta->nombre = $request->input('Nombre');
        $receta->ingredientes = $request->input('Ingredientes');
        $receta->edad = $request->input('Edad');
        $receta->ingredientes_alternativos = $request->input('IngredientesAlternativos');
        $receta->pasos = $request->input('Pasos');
        $receta->ruta_imagen = $name;

        $receta->save();

        return back()->with('mensaje','registroexito');
    }
    public function editar($id)
    {
        $receta = Receta::find($id);
        return view('receta.editarReceta',compact('receta'));
    }

    public function actualizar($id,Request $request)
    {
        $receta = Receta::find($id);
        //dd($request);
        $receta->update([
        'nombre'=> $request->Nombre,
        'edad'=> $request->Edad,
        'ingredientes'=> $request->Ingredientes,
        'ingredientes_alternativos'=> $request->IngredientesAlternativos,
        'pasos'=> $request->Pasos]);
        return view('receta.editarReceta',compact('receta'));
    }
}
