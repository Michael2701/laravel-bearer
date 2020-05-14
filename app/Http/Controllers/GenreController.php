<?php

namespace App\Http\Controllers;

use App\models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function getGenres(){
        return Genre::select('*')->orderBy('name')->get();
    }
}
