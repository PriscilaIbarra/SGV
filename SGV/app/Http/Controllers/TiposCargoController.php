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
        $tip = TiposCargo::select(['tipos_cargos.id','tipos_cargos.descripcion']);
        $tip->where('tipos_cargos.estado', '!=','inactivo');
        $tipos = $tip->get(); 
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
        
        $messages = [ 'nombre.regex'=>'Formato de descripcion incorrecto',
          'descripcion.required'=>'Complete el campo requerido',
          'descripcion.max'=>'La longitud del nombre supera el máximo requerido',
        ];  
        
        $validacion = $this->validate($request,$rules,$messages);
     
     if($validacion)
     {
        $tip = new TiposCargo();
        $tip->descripcion = trim($request['descripcion']);
        $tip->save(); 
        return redirect('abmlTipoCargo')->with('success','TipoCargo registrado con éxito');
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
        $tip = TiposCargo::find($id);

        if(isset($tip))
        {
          return view('Administrador.editarTiposCargos',compact('tip'));  
        }
        else
        {
          return back()->with('error','TipoCargo no encontrado.');
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
      $tip = TiposCargo::select('id')->where('id','=',$request['id']);
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
        $tip = TiposCargo::find($request['id']);
        $tip->descripcion = $request['descripcion'];
        $tip->update();
        return redirect('abmlTipoCargo')->with('success','Tipo Cargo actualizado con éxito');
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
        $tip = TiposCargo::find($id);
        if(isset($tip))
        {
           $tip->estado = 'inactivo';
           $tip->save(); 
           return back()->with('success','TipoCargo eliminado con éxito.');
        }
        else
        {
           return back()->with('error','TipoCargo no encontrado');
        }    
    }
}
