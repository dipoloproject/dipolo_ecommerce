<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\UserDev;




class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function login(){
        return view('administration/login/login');
    }

    public function authenticate(Request $request){
            /*echo $request->login_usuario;
            echo $request->login_password;exit;*/

        $argumentos=[
            $request->login_usuario,
            $request->login_password
        ];

        $existe_usuario = UserDev::Existe($argumentos);     //echo "<pre>";var_dump($existe_usuario[0]);exit;


        if( $existe_usuario[0]->mensaje == 'si_existe'){
            session_start();
            $_SESSION['user_login']= true;      // CREACION DE VARIABLE DE SESSION -> USUARIO LOGUEADO
        }

        return response()->json([
            /*  Aquí sí se definen ambas keys. 
                La key-value 'mensaje_error'="" quiere decir que NO hubo errores al cargar archivos */
                'mensaje_error'=> "Credenciales incorrectas",
                'mensaje_existe_usuario'=> $existe_usuario[0]->mensaje
        ]); //  esto se retorn al ajax

    }





    public function index()
    {
        //
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
}
