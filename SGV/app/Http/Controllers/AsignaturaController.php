<?php

namespace Cinema\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Cinema\Asignatura;
use Cinema\Vacante;
use Cinema\User;
use Illuminate\Database\Eloquent\Builder;


class AsignaturaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() //lista todas las asignaturas con vacantes vigentes para el perfil público
    {
        $asign = Asignatura::join('vacantes','asignaturas.id','=','vacantes.id_asignatura')
                       ->select(['asignaturas.id','asignaturas.descripcion'])
                       ->distinct()
                       ->where('vacantes.fecha_apertura','<=',date('Y-m-d'))
                       ->where('vacantes.fecha_cierre','>=',date('Y-m-d'))
                       ->whereNull('vacantes.deleted_at')
                       ->whereNull('asignaturas.deleted_at');
        $asignaturas = $asign->get();               
        return view('listadoMateriasConVacantes',compact('asignaturas'));               
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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


    public function getAsignaturasConVacantes()
    { 
        //mostrar materias con vacantes disponibles - un usuario se puede inscribir a muchas vacantes dentro de la misma materia.
        $asig = Asignatura::join('vacantes','asignaturas.id','=','vacantes.id_asignatura')
                 ->select(['asignaturas.id','asignaturas.descripcion'])
                 ->distinct()
                 ->where('vacantes.fecha_apertura','<=',date('Y-m-d'))
                 ->where('vacantes.fecha_cierre','>=',date('Y-m-d'))
                 ->whereNull('vacantes.deleted_at')
                 ->whereNull('asignaturas.deleted_at');               
        $asignaturas = $asig->get();        
        return view('Usuario.listAsignaturasConVacantes',compact('asignaturas'));
    }

    public function getAll()
    {
        $asignaturas = Asignatura::all();
        $jefesCatedra = User::whereHas('tipo_usuario',function(Builder $query){
            $query->where('descripcion','like','Jefe de Catedra');
        })->get();

        return view('Administrador.asignarJefeCatedra',compact('asignaturas','jefesCatedra'));
    }

    public function asignarJefe(Request $request)
    {
        $asignatura= Asignatura::find($request["asignatura"]);
        $jefesCatedra= User::find($request["id_jefe_catedra"]);
        if(isset($asignatura) && isset($jefesCatedra))
        {
            $asignatura->id_jefe_catedra_calificador=$request["id_jefe_catedra"];
            $asignatura->save();
            return back()->with('success','Jefe de catedra asignado con exito');
        }
        else
        {
            return back()->with('error','No se pudo completar la operación');
        }
    }
}   
 