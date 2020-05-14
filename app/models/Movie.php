<?php

namespace App\models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $table = 'movies';

    public static function getMovies(){
        return self::select('*')->limit(25)->get();
    }

    public static function searchMovies(Request $request){

        $req = self::select('*');

        if($request->search){
          if($request->search['author']){
              $req->where('author', 'like', "%{$request->search['author']}%");
          }
          if($request->search['country']){
              $req->where('country', 'like', "%{$request->search['country']}%");
          }
          if($request->search['genre']){
              $req->where('genre', 'like', "%{$request->search['genre']}%");
          }
          if($request->search['year']){
              $req->where('year', 'like', "%{$request->search['year']}%");
          }
          if($request->search['title']){
              $req->where('title', 'like', "%{$request->search['title']}%");
          }
        }



        $count = $req->count();

        $pageSize = $request->pagination['pageSize'];
        $pageIndex = $request->pagination['pageIndex'];
        $pageSize = $pageSize ? $pageSize : 25;
        $pageIndex = $pageIndex ? $pageIndex : 0;

        $movies =  $req
        ->limit($pageSize)
        ->offset($pageIndex*$pageSize)->get();

        return [
            "length" => $count,
            "pageSize" => $pageSize,
            "pageIndex" => $pageIndex,
            "movies" => $movies
        ];
    }
}
