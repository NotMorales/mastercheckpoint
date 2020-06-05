<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB;

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
    protected $redirectTo = '/';

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
            'Nombre'            => ['required', 'string', 'max:255'],
            'ApellidoPaterno'   => ['required', 'string', 'max:255'],
            'ApellidoMaterno'   => ['required', 'string', 'max:255'],
            'Telefono'          => ['required', 'Numeric'],
            'Matricula'         => ['required', 'string', 'max:255', 'unique:users'],
            'Email'             => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'          => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $idpersona = DB::table('persona')->insertGetId(
            ['nombre' => $data['Nombre'], 'apellidoPaterno' => $data['ApellidoPaterno'], 'apellidoMaterno' => $data['ApellidoMaterno'], 'telefono' => $data['Telefono']]
        );

        return User::create([
            'roleId' => 2,
            'personaId' => $idpersona,
            'matricula' => $data['Matricula'],
            'email' => $data['Email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
