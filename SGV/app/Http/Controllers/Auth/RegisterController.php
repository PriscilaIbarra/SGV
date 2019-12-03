<?php

namespace Cinema\Http\Controllers\Auth;

use Cinema\User;
use Cinema\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Cinema\TiposUsuarios;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nombre' => ['required','regex:/^[A-Za-z\s-_]+$/', 'max:255'],
            'apellido' => ['required','regex:/^[A-Za-z\s-_]+$/' , 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'dni' => ['required', 'regex:/^[0-9]+$/', 'digits:8'],
            'telefono'=>['required','regex:/^[0-9]+$/','max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],            
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \Cinema\User
     */

    protected function create(array $data)
    {
       
        try
        {
            $tipo_usuario= TiposUsuarios::where('descripcion','like','Usuario')->whereNull('deleted_at')->firstOrFail();
            return User::create([
            'nombre' => $data['nombre'],
            'apellido' => $data['apellido'],
            'email' => $data['email'],
            'dni' => $data['dni'],
            'telefono'=>$data['telefono'],
            'password' => Hash::make($data['password']),
            'id_tipo_usuario'=> $tipo_usuario->id,
            
             ]);
        }
        catch(Exception $e)
        {
            return redirect(route('register'))->with('error','Error al registrar Usuario');
        }

     
    }

    
}
