<?php

namespace Cinema\Http\Controllers;

use Illuminate\Http\Request;
use Cinema\TiposCargo;

class TiposCargoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipos = TiposCargo::where('estado', '!=','inactivo')->get();      
        return view('Administrador.abmlTipoCargos',compact('tipos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('Administrador.altaTiposCargos');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'descripcion' => ['required','regex:/^[A-Za-z\s-_]+$/', 'max:255'],
          ];
        
        $messages = [ 'descripcion.regex'=>'Formato de descripcion incorrecto',
          'descripcion.required'=>'Complete el campo requerido',
          'descripcion.max'=>'La longitud del nombre supera el máximo requerido',
        ];  
        
        $validacion = $this->validate($request,$rules,$messages);
     
     if($validacion)
     {
        $tip = new TiposCargo();
        $tip->descripcion = $request['descripcion'];
        $tip->save(); 
        return redirect('abmlTipoCargo')->with('success','Tipo de Cargo registrado con éxito.');
     }          
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tipo = TiposCargo::find($id);

        if(isset($tipo))
        {
          return view('Administrador.editarTiposCargos',compact('tipo'));  
        }
        else
        {
          return back()->with('error','Tipo de Cargo no encontrado.');
        }    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
      $rules = [
                'descripcion' => ['required','regex:/^[A-Za-z\s-_]+$/', 'max:255'],
               ];   

      $messages = [ 
                    'descripcion.regex'=>'Formato de tipo cargo incorrecto',
                    'descripcion.required'=>'Complete el campo requerido',
                    'descripcion.max'=>'La longitud del tipo de cargo supera el máximo requerido',
                  
                  ];          

     $validacion = $this->validate($request,$rules,$messages);

     if($validacion)
     {
        $tipo = TiposCargo::find($request['id']);
        if($isset($tipo)){
            $tipo->descripcion = $request['descripcion'];
        $tipo->update();
        return redirect('abmlTipoCargo')->with('success','Tipo de Cargo actualizado con éxito.');
        }
        else{
            return redirect('abmlTipoCargo')->with('error','Tipo de Cargo no encontrado');
        }
     }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function logic_delete($id)
    {
        $tipo = TiposCargo::find($id);
        if(isset($tipo))
        {
           $tipo->estado = 'inactivo';
           $tipo->save(); 
           return back()->with('success','Tipo de Cargo eliminado con éxito.');
        }
        else
        {
           return back()->with('error','Tipo de Cargo no encontrado.');
        }    
    }
}
