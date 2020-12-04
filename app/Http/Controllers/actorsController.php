<?php

namespace App\Http\Controllers;

use App\Actor;
use Illuminate\Http\Request;

class actorsController extends Controller
{
    public function index(){

        //Lista os dados da tabela actors
        $actors = Actor::all();

        //Caso encontre algum registro, é retornado no formato JSON
        if (!$actors->isEmpty()){
            return response()->json($actors,200);
        }else{
            return response()->json([
                "message" => "Não há registros!"
            ], 206);
        }
    }

    public function create(Request $request){
        $data = $request->all();

        try{
            Actor::create($data);
            return response()->json([
                "message" => "Ator cadastrado com sucesso!"
            ], 201);
        }catch (\Exception $e){
            return response()->json($e, 500);
        }
    }
}
