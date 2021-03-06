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

        $this->validate(request(),[
          
            'Nombre' => ['required' ,'max:40', 'regex:/^[\pL\s\-]+$/u'],
            'imagen' => ['required', 'file:4096','image' ],
            'Ingredientes' =>['required', 'max:1000'  ],
            'Edad' =>['required', 'numeric'],
            'IngredientesAlternativos' =>['max:1000'],
            'Tipo' =>['required'],
            'Calorias' =>['required'],
            'Pasos' =>['required', 'max:3000' ]
        ]);
        
        //dd($request);
        if($request->hasFile('imagen')){
            $validatedData = $request->validate([
             'imagen' => 'required|mimes:jpeg,png,jpg',
            ]);
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
        $receta->tipo = $request->Tipo;
        $receta->calorias = $request->Calorias;
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
        $this->validate(request(),[
          
            'Nombre' => ['required' ,'max:40', 'regex:/^[\pL\s\-]+$/u'],
            'imagen' => [ 'file:4096','image' ],
            'Ingredientes' =>['required', 'max:1000'  ],
            'Edad' =>['required', 'numeric'],
            'IngredientesAlternativos' =>['max:1000'],
            'Pasos' =>['required', 'max:3000' ],
            'Calorias' =>['required'],
            'Tipo' =>['required'],
        ]);

        $receta = Receta::find($id);
        $name = $receta->ruta_imagen;

        if($request->hasFile('imagen')){
            $validatedData = $request->validate([
             'imagen' => 'required|mimes:jpeg,png,bmp,jpg',
            ]);
            $file = $request->file('imagen');
            $name = time().$file->getClientOriginalName();
            $file->move(public_path().'/images/',$name);

        }
        
        $receta->update([
        'nombre'=> $request->Nombre,
        'edad'=> $request->Edad,
        'ingredientes'=> $request->Ingredientes,
        'ingredientes_alternativos'=> $request->IngredientesAlternativos,
        'pasos'=> $request->Pasos, 
        'calorias'=> $request->Calorias,
        'tipo'=> $request->Tipo,  
        'ruta_imagen'=> $name]);
        //return view('receta.editarReceta',compact('receta'))->with('mensaje','registroexito');
        return back()->with('mensaje','registroexito');
    }
}
