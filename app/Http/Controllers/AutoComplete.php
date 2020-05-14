<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class AutoComplete extends Controller
{
    public function autoComlete(){
      $countries = DB::table('countries2')->select('name')->get()->pluck('name')->toArray();
      $years = range(1900, 2020);
      $genres =  DB::table('genres')->select('name')->get()->pluck('name')->toArray();

      return [
        "genres"    => $genres,
        "years"     => $years,
        "countries" => $countries
      ];
    }
}
