<?php

namespace Cinema\Http\Controllers;

use Illuminate\Http\Request;
use Cinema\Novedad;
use Cinema\User;
use Cinema\Vacante;
use Cinema\Inscripcion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InscripcionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inscripciones = Inscripcion::where('id_usuario','=',Auth::user()->id)->get();
        return view('Usuario.listadoInscripciones',compact('inscripciones'));
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
                          ->select('vacantes.id','asignaturas.descripcion as asig_desc','tipos_cargos.descripcion as desc_tipo_cargo')->get();
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
      $rules = [
                   'cv'=>['required'],
                   'disponibilidad_horaria'=>['required','string'],
                ];   

       $messages = [ 
                    'cv.required'=>'Adjunte su cv',
                    'disponibilidad_horaria.required'=>'Complete su disponibilidad horaria',
                    'disponibilidad_horaria.string'=>'Formato incorrecto',
                   ];       

       $validacion = $this->validate($request,$rules,$messages);
 

     if($validacion)
     {   

      
         DB::transaction(function() use ($request){
          
            $user = User::findOrFail(Auth::user()->id);

            $user->novedades()->attach($request->input('novedades'));
            
            $nombre = str_replace ('.','_',$request->file('cv')->getClientOriginalName());
            $extension = $request->file('cv')->getClientOriginalExtension();
            $nombreCv = time().'_'.$nombre.'.'.$extension;
            $ruta = $request->file('cv')->storeAs('public/cvs',$nombreCv);   
            $request->file('cv')->move(public_path('../public/cvs'),$nombreCv);       
            $vacante = Vacante::findOrFail($request['id_vacante']);
            $ins = new Inscripcion();
            $ins->cv = $ruta;
            $ins->id_vacante = $vacante->id; 
            $ins->id_usuario = $user->id;
            $ins->disponibilidad_horaria = $request['disponibilidad_horaria'];
            $ins->save(); 
        });

     
        return redirect('listadoInscripciones')->with('success','Inscripción  registrada con éxito');
       
        //return  back()->with('success','ss'); 
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
