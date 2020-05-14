<?php

namespace App\Http\Controllers;

use App\models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function getMovies(){
        $movies = Movie::getMovies();
        return $movies;
    }

    public function searchMovies(Request $request){
        $movies = Movie::searchMovies($request);

        //return $movies;

        return $movies ? $movies : ['success' => false, 'message' => 'Somthing went wrong'];
    }
}
