<?php

namespace App\Http\Controllers;

use App\Models\TipoIdentificacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TipoIdentificacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(TipoIdentificacion::get());
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
            'nombre' => 'required|max:25|unique:TipoIdentificacion',
        ]);

        if ($validacion->fails())
        {
            return response()->json(["mensaje"=>$validacion->errors()->all(),"error"=>true],400);
        }

        $tipoIdentificacion = TipoIdentificacion::create($request->all());
        return response()->json(["mensaje"=>"Registro guardado con exito.","error"=>false],201);
    }

    /**
     * Display the specified resource.
     *
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
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
            'nombre' => 'required|max:25|unique:TipoIdentificacion',
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
     * Remove the specified resource from storage.
     *
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
