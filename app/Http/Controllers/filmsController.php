<?php

namespace App\Http\Controllers;

use App\Classification;
use App\Director;
use App\Film;
use Illuminate\Database\Events\TransactionBeginning;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class filmsController extends Controller
{
    public function index(){
        //Lista os dados da tabela films
        $films = Film::all();

        //Caso encontre algum registro, é retornado no formato JSON
        if (!$films->isEmpty()){
            return response()->json($films,200);
        }else{
            return response()->json([
                "message" => "Não há registros!"
            ], 206);
        }
    }

    public function filmsForDirector($id){
        //Array que servirá para ser populado de acordo com os items escolhidos;
        $array = [];

        $directors          = Director::where('id', '=', $id)->with('listFilms')->get();

        foreach ($directors as $director){
            $directorName = $director->name;
            $films = $director->listFilms;

            foreach ($films as $film){
                $classificationId = $film->classification_id;

                $classes = Classification::where('id' , '=',  $classificationId)->get();

                foreach ($classes as $classe){
                    $classificationName = $classe->name;
                    $array[$classificationName][] = $film->name;
                }
            }
        }

        if (!$directors->isEmpty()){
            return response()->json([
                'Diretor' => $directorName,
                'Classificação' => $array

            ], 200);
        }else{
            return response()->json([
                "message" => "Não há registros!"
            ], 206);
        }
    }

    public function create(Request $request){

        $data = $request->all();

        $dataFilm  = $request->only(['name', 'classification_id', 'director_id']);
        $dataActor = $data['actors'];

        $arrayActors = explode(",", $dataActor);

        try{
            DB::beginTransaction();
            //Insere dentro do banco de dados na Tabela films
            $lastId = Film::create($dataFilm)->id;

            $film = Film::find($lastId);

            //Insere a lista dos atores  com o respectivo filme na tabela pivot
            $pivot = $film->listActors()->sync($arrayActors);

            if ($pivot){
                DB::commit();
            }
            return response()->json([
                "message" => "Filme inserido com sucesso!"
            ], 201);
        }catch (\Exception $e){
            //Cajo haja alguma exceção é retoranado a mensagem do erro
            DB::rollBack();
            return response()->json($e, 500);
        }

    }

    public function searchFilm($id){

        $film = Film::where('id', '=' , $id)->get()->first();

        $arrayFilms = [];

        if (isset($film)){
            $listFilms = $film->listActors;

            $nameFilm = $film->name;
            foreach ($listFilms as $cine){
                $arrayFilms[] = $cine->name;
            }

            return response()->json([
                "Filme" => $nameFilm ,
                "Atores" => $arrayFilms

            ], 200);
        }else
            return response()->json([
                "message" => "Não há registros!"
            ], 206);
    }

}