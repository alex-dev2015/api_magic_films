<?php

namespace App\Http\Controllers;

use App\Director;
use Illuminate\Http\Request;

class directorsController extends Controller
{
    public function index(){

        //Lista os dados da tabela de diretores
        $directors = Director::all();

        //Caso encontre algum registro, é retornado no formato JSON
        if (!$directors->isEmpty()){
            return response()->json($directors,200);
        }else{
            return response()->json([
                "message" => "Não há registros!"
            ], 206);
        }
    }

    public function create(Request $request){

        //Pega os dados da requisição
        $data = $request->all();

        try{

            //Insere dentro do banco de dados na Tabela directors
            Director::create($data);

            return response()->json([
                "message" => "Diretor cadastrado com sucesso!"
            ], 201);
        }catch (\Exception $e){
            //Cajo haja alguma exceção é retoranado a mensagem do erro
            return response()->json($e, 500);
        }
    }
}
