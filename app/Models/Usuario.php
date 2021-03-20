<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
class Usuario extends Model
{
    use HasFactory;

    public static  function getAll(){
        return DB::select('CALL SP_ALL_USUARIOS()');
    }

    public static  function get($id){
        return collect(\DB::select('CALL SP_GET_USUARIO(?)',array($id)))->first();
    }

    public static  function guardar(Request $request){
        return DB::select('CALL SP_CREATE_USUARIO(?,?,?,?,?)',array($request->input("identificacion"),$request->input("nombre"),$request->input("apellidos"),$request->input("email"),$request->input("tipo_identificacion_cod")));
    }

    public static  function eliminar($id){
        return DB::select('CALL SP_DELETE_USUARIO(?)',array($id));
    }

    public static  function actualizar(Request $request){
        $datos = array($request->input("id"),$request->input("identificacion"),$request->input("nombre"),$request->input("apellidos"),$request->input("email"),$request->input("tipo_identificacion_cod"));
        return DB::select('CALL SP_UPDATE_USUARIO(?,?,?,?,?,?)',$datos);
    }

}
