<?php

namespace Cinema\Http\Controllers;

use Illuminate\Http\Request;
use Cinema\User;
use Cinema\Vacante;
use Cinema\Inscripcion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use Cookie;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;

class InscripcionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inscripciones = Inscripcion::where('id_usuario','=',Auth::user()->id)->whereHas('vacante',function(Builder $query)
            {
                  $query->where('estado','!=','cancelada');
            })->get(); 
        return view('Usuario.listadoInscripciones',compact('inscripciones'));            
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id_vacante)
    {
        $vacante = Vacante::find($id_vacante);    
        if(isset($vacante))
        {
          return view('Usuario.inscripcionVacante', compact('vacante'));    
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
                   'cv'=>['required','mimetypes:application/pdf'],
                   'disponibilidad_horaria'=>['required','string'],
                ];   

       $messages = [ 
                    'cv.required'=>'Adjunte su cv',
                    'cv.mimetypes'=>'El curriculum a adjuntar debe tener formato pdf',
                    'disponibilidad_horaria.required'=>'Complete su disponibilidad horaria',
                    'disponibilidad_horaria.string'=>'Formato incorrecto',
                   ];       

       $validacion = $this->validate($request,$rules,$messages);
 

     if($validacion)
     {   

      
         DB::transaction(function() use ($request){
          
            $user = User::findOrFail(Auth::user()->id);          
            
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
        
        return redirect(route('listadoInscripciones'))->with('success','Inscripción  registrada con éxito');
             
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

    public function getInscripcionesByVacante($idVacante)
    {
        
        $vacante=Vacante::find($idVacante);

        if(isset($vacante))
        {
            $inscripciones= Inscripcion::where("id_vacante","=",$idVacante)->get();
            
            if(empty($inscripciones))
            {
                return view("JefeCatedra.listaInscriptos",compact('inscripciones','vacante'));
            }
            else
            {

                //retornar en la misma pantalla que no hay inscriptos corregir
                return redirect('homeJefeCatedra')->with('error','Sin inscripciones.');
            }
        }    
        else
        {
            return redirect('homeJefeCatedra')->with('error','No se ha encontrado la vacante');
        }            

    }
   

    public function updateCalificaciones(Request $request) //actualiza las nuevas calificaciones ingresadas
    {   

        try
        {
         $validacion=Validator::make($request->input('inscripciones'),
                [
                    'inscripciones'=>'numeric|between:0,10.0'
                ]);
         
          if($validacion)
          {
            DB::transaction(function() use ($request)
                    {
                  
                            $inscripciones = $request->input('inscripciones');
                            
                            foreach($inscripciones as $key => $value)
                            {
                                $i=Inscripcion::find($key);                        
                                $i->calificacion = $value;
                                $i->save();
                            }
                         
                    });
            
                if(isset($request["opcion"]))
                {
                        if(strcasecmp($request["opcion"],'Publicar')==0)
                        {
                            return redirect(route('confecionarOrdenMerito',$request["idVacante"]));
                        }

                }

                return back()->with('success','Calificaciones actualizadas con éxito');
            }
            else
            {
                return back()->with('error','Alguno de los campos posee formato incorrecto');
            }

        }
        catch(QueryException $e)
        {
           
            return back()->with('error','Error al actualizar calificaciones');
        }            

    }

 

}
