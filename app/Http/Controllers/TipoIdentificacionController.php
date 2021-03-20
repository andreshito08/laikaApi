<?php

namespace App\Http\Controllers;

use App\Models\TipoIdentificacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TipoIdentificacionController extends Controller
{
    /**
     * Ver todos los recursos
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(TipoIdentificacion::get());
    }

    /**
     * Crear un recurso
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //Validar campos
        $validacion = Validator::make($request->all(), [
            'nombre' => 'regex:/^[\pL\s\-]+$/u|required|max:25',
        ]);

        if ($validacion->fails())
        {
            return response()->json(["mensaje"=>$validacion->errors()->all(),"error"=>true],400);
        }

        $tipoIdentificacion = TipoIdentificacion::create($request->all());
        return response()->json(["mensaje"=>"Registro guardado con exito.","error"=>false],201);
    }

    /**
     * Ver un recurso
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tipoIdentificacion = TipoIdentificacion::find($id);

        if($tipoIdentificacion==null){
            return response()->json(["mensaje"=>"El registro no existe.","error"=>true],404);
        }

        return response()->json($tipoIdentificacion,200);
    }

    /**
     * Actualizar  un recurso
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        if($id!=$request->input("id")){
            return response()->json(["mensaje"=>"","error"=>true],400);
        }

        //Validar campos
        $validacion = Validator::make($request->all(), [
            'id' => 'required|numeric',
            'nombre' => 'regex:/^[\pL\s\-]+$/u|required|max:25',
        ]);

        if ($validacion->fails())
        {
            return response()->json(["mensaje"=>$validacion->errors()->all(),"error"=>true],400);
        }

        $tipoIdentificacion = TipoIdentificacion::find($id);
        //Validar si existe
        if($tipoIdentificacion==null){
            return response()->json(["mensaje"=>"El registro a actualizar no existe.","error"=>true],400);
        }

        //Actualizar
        $tipoIdentificacion->update($request->all());
        return response()->json(["mensaje"=>"Registro actualizado con éxito.","error"=>false],200);
    }

    /**
     * Eliminar un recurso
     * ESTE RECURSO NO DEBRIA EXISTIR POR INTEGRIDAD, PERO DE DESARROLLO PARA ILUSTRAR EL EJERCICIO
     * @param  \Illuminate\Http\Request  $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $tipoIdentificacion = TipoIdentificacion::find($id);

        if($tipoIdentificacion==null){
            return response()->json(["mensaje"=>"El registro a eliminar no existe.","error"=>true],400);
        }

        $tipoIdentificacion->delete();
        return response()->json(["mensaje"=>"Registro eliminado con éxito.","error"=>false],200);
    }
}
