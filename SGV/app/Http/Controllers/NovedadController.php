<?php

namespace Cinema\Http\Controllers;

use Illuminate\Http\Request;

class NovedadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nov = Novedad::select(['novedades.id','novedades.descripcion']);
        $nov->where('novedades.estado', '!=','inactivo');
        $novedades = $nov->get(); 
        return view('Administrador.abmlNovedades',compact('novedades'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Administrador.altaNovedades');
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
        $nov = new Novedad();
        $nov->descripcion = trim($request['descripcion']);
        $nov->save(); 
        return redirect('abmlNovedades')->with('success','Novedad registrada con éxito.');
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
        $nov = Novedad::find($id);

        if(isset($nov))
        {
          return view('Administrador.editarNovedades',compact('nov'));  
        }
        else
        {
          return back()->with('error','Novedad no encontrada.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $nov = Novedad::select('id')->where('id','=',$request['id']);
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
        $nov = Novedad::find($request['id']);
        $nov->descripcion = $request['descripcion'];
        $nov->update();
        return redirect('abmlNovedades')->with('success','Novedad actualizada con éxito.');
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
        $nov = Novedad::find($id);
        if(isset($nov))
        {
            if($now.estado=='inactivo')
            {
                $nov->estado = 'activo';
                $nov->save();
                return back()->with('success','Novedad habilitada con éxito.');
            }
            else{
                $nov->estado = 'inactivo';
                $nov->save();
                return back()->with('success','Novedad deshabilitada con éxito.');
            }
           
            
           
        }
        else
        {
           return back()->with('error','Novedad no encontrada.');
        }    
    }
}
