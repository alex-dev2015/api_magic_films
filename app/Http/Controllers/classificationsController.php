<?php

namespace App\Http\Controllers;

use App\Classification;
use Illuminate\Http\Request;

class classificationsController extends Controller
{
    public function index(){
        $classification = Classification::all();

        if (!$classification->isEmpty()){
            return response()->json($classification,200);
        }else{
            return response()->json([
                "message" => "Não há registros!"
            ], 206);
        }
    }

    public function create(Request $request){
       $data = $request->all();

       try{
           Classification::create($data);
           return response()->json([
               "message" => "Classificação cadastrada com sucesso!"
           ], 201);
       }catch (\Exception $e){
           return response()->json($e, 500);
       }
    }
}
