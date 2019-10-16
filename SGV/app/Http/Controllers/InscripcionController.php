<?php

namespace Cinema\Http\Controllers;

use Illuminate\Http\Request;
use Cinema\Novedad;
use Cinema\Vacante;

class InscripcionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id_vacante)
    {
        $novedades = Novedad::select('id','descripcion')->where('estado','=','activo')->get();
        $vacan = Vacante::join('asignaturas','vacantes.id_asignatura','=','asignaturas.id')
                          ->join('tipos_cargos','vacantes.id_tipo_cargo','=','tipos_cargos.id')
                          ->join('departamentos','vacantes.id_departamento','=','departamentos.id')
                          ->where('departamentos.descripcion','LIKE','Ingenieria en Sistemas de Información')
                          ->where('vacantes.id','=',$id_vacante)
                          ->select('asignaturas.descripcion as asig_desc','tipos_cargos.descripcion as desc_tipo_cargo')->get();
        $vacante = $vacan[0];     
        if(isset($novedades) && isset($vacante))
        {
          return view('Usuario.inscripcionVacante', compact('novedades','vacante'));    
        }
        else
        {
          return back()->with('error','Error al generar formulario de Inscripción'); 
        }    
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
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
}
