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
     * Crear un recurso
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //Maroma :)
        $valid = "max:50";
        if($request->input("email")!=null){
            $valid = 'email|max:50';
        }
        //Validar campos
        $validacion = Validator::make($request->all(), [
            'identificacion' => 'required|numeric',
            'tipo_identificacion_cod' => 'required|numeric',
            'nombre' => 'required|max:25|regex:/^[\pL\s\-]+$/u',
            'apellidos' => 'required|max:50|regex:/^[\pL\s\-]+$/u',
            'email' => $valid
        ]);

        if ($validacion->fails())
        {
            return response()->json(["mensaje"=>$validacion->errors()->all(),"error"=>true],400);
        }

        Usuario::guardar($request);
        return response()->json(["mensaje"=>"Registro guardado con éxito.","error"=>false],201);
    }

    /**
     * Ver un recurso
     * @param int $id
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
     * Actualizar  un recurso
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($id!=$request->input("id")){
            return response()->json(["mensaje"=>"","error"=>true],400);
        }

        //Maroma :)
        $valid = "max:50";
        if($request->input("email")!=null){
            $valid = 'email|max:50';
        }
        //Validar campos
        $validacion = Validator::make($request->all(), [
            'id' => 'required|numeric',
            'identificacion' => 'required|numeric',
            'tipo_identificacion_cod' => 'required|numeric',
            'nombre' => 'required|max:25|regex:/^[\pL\s\-]+$/u',
            'apellidos' => 'required|max:50|regex:/^[\pL\s\-]+$/u',
            'email' => $valid
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
     * Eliminar un recurso
     * ESTE RECURSO NO DEBRIA EXISTIR POR INTEGRIDAD, PERO DE DESARROLLO PARA ILUSTRAR EL EJERCICIO
     * @param  \Illuminate\Http\Request  $request
     * @param $id
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
