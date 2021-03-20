<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UsuarioController extends Controller
{
    /**
     * Obtener todoa los registros
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Usuario::getAll(),200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //Validar campos
        $validacion = Validator::make($request->all(), [
            'identificacion' => 'required|numeric',
            'tipo_identificacion_cod' => 'required|numeric',
            'nombre' => 'required|max:25|alpha',
            'apellidos' => 'required|max:50|alpha',
            'email' => 'max:50'
        ]);

        if ($validacion->fails())
        {
            return response()->json(["mensaje"=>$validacion->errors()->all(),"error"=>true],400);
        }

        Usuario::guardar($request);
        return response()->json(["mensaje"=>"Registro guardado con éxito.","error"=>false],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $usuario = Usuario::get($id);

        if($usuario==null){
            return response()->json(["mensaje"=>"El registro no existe.","error"=>true],404);
        }

        return response()->json($usuario,200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($id!=$request->input("id")){
            return response()->json(["mensaje"=>"","error"=>true],400);
        }

        //Validar campos
        $validacion = Validator::make($request->all(), [
            'id' => 'required|numeric',
            'identificacion' => 'required|numeric',
            'tipo_identificacion_cod' => 'required|numeric',
            'nombre' => 'required|max:25|alpha',
            'apellidos' => 'required|max:50|alpha',
            'email' => 'max:50'
        ]);

        if ($validacion->fails())
        {
            return response()->json(["mensaje"=>$validacion->errors()->all(),"error"=>true],400);
        }

        if(Usuario::get($id)==null) {
            return response()->json(["mensaje"=>"El registro a actualizar no existe.","error"=>true],400);
        }

        Usuario::actualizar($request);
        return response()->json(["mensaje"=>"Registro actualizado con éxito.","error"=>false],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usuario = Usuario::get($id);

        if($usuario==null){
            return response()->json(["mensaje"=>"El registro a eliminar no existe.","error"=>true],400);
        }

        Usuario::eliminar($id);
        return response()->json(["mensaje"=>"Registro eliminado con éxito.","error"=>false],200);
    }
}
