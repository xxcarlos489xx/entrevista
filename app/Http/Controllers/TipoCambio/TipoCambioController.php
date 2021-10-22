<?php

namespace App\Http\Controllers\TipoCambio;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\TipoCambio as TC;
use Auth;
use DB;

class TipoCambioController extends Controller
{
    public function index(){
        
        $rol = Auth::user()->rol->tipo;
        return view('admin.gestionCambio.index',[
            'rol' => json_encode($rol),
        ]);
    }
    public function edit($id){
        $tc = TC::find($id);
        return view('admin.gestionCambio.edit',[
            'tc' => json_encode($tc),
        ]);
    }
    public function add(){
        
        return view('admin.gestionCambio.add');
    }
    //API
    public function getRegistros(){
        $rol = Auth::user()->rol->tipo;
        
        if ($rol === 'Administrator') {
            $registros = TC::withTrashed()->paginate(5);
        }else{
            $registros = TC::paginate(5);
        }
        return response()->json($registros);
    }
    public function save(Request $request){
        $data = $request->all();
        
        $valor_compra = number_format($data['tc_compra'],3);
        $valor_venta = number_format($data['tc_venta'],3);
        
        DB::beginTransaction();

        $tc = new TC();
        $tc->valor_compra = $valor_compra;
        $tc->valor_venta = $valor_venta;
        $tc->pais = 'PE';
        $tc->tipo_moneda = 'PEN';
        $tc->activo = 0;
        
        if($tc->save()){
            DB::commit();
            return response()->json([   "save" => true,
                                        "message"=>"Registro creado con éxito!"]);
        }else{
            DB::rollback();
        }
    }

    public function editTc(Request $request){
        $data = $request->all();
        $tc = TC::find($data['id']);
        $tc->valor_compra = number_format($data['tc_compra'],3);
        $tc->valor_venta = number_format($data['tc_venta'],3);
        
        if ($tc->save()) {
            return response()->json([   "edit" => true,
                                        "message"=>"Registro editado con éxito!"]);
        }
    }

    public function deleteTc($id){
        $rol = Auth::user()->rol->tipo;;
        $tc = TC::find($id);
        
        if ($tc->activo == 1) {
            return response()->json([   "delete" => false,
                                        "message"=>"Primero debe desactivar el registro!"]);
        }
        if ($rol != 'Administrator') {
            return response()->json([   "delete" => false,
                                        "message"=>"No esta autorizado para realizar esta accion"]);
        }
        
        if($tc->delete()){
            return response()->json([   "delete" => true,
                                        "fecha"  => $tc->deleted_at,
                                        "message"=>"Registro eliminado con éxito"]);
        }
    }

    public function deleteForceTc($id){
        $rol = Auth::user()->rol->tipo;;
        $tc = TC::withTrashed()->find($id);

        if ($rol != 'Administrator') {
            return response()->json([   "delete" => false,
                                        "message"=>"No esta autorizado para realizar esta accion"]);
        }
        if($tc->forceDelete()){
            return response()->json([   "delete" => true,
                                        "fecha"  => $tc->deleted_at,
                                        "message"=>"Registro eliminado con éxito"]);
        }
    }

    public function changeEstado($id){
        $tc = TC::withTrashed()->find($id);
        $activos = TC::whereActivo(1)->where('id','!=',$tc->id)->count();
        
        if ($tc->deleted_at) {
            return response()->json([   "change" => false,
                                        "message"=>"Este registro fue eliminado!"]);
        }
        if ($activos > 0) {
            return response()->json([   "change" => false,
                                        "message"=>"Ya tiene un tipo de cambio activo"]);
        }
        $tc->activo = $tc->activo == '0' ? '1' : '0';
        $tc->save();
        return response()->json([   "activo"=>$tc->activo,
                                    "change" => true,
                                    "message"=>"Estado actualizado!"]);
    }
}
