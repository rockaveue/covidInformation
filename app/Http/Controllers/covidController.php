<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class covidController extends Controller
{
    public function search(){
        $jsonResponse = Http::get('https://api.covid19api.com/');
        $response = json_decode($jsonResponse);
        // $jsonResponse -> json(): array|mixed;
        return view('search', compact('response'));
    }
    public function index(){
        $jsonResponse = Http::get('https://api.covid19api.com/summary');
        $response = json_decode($jsonResponse);
        // $jsonResponse -> json(): array|mixed;
        $jsonResponse2 = Http::get('https://api.covid19api.com/dayone/country/mongolia');
        $dayone = json_decode($jsonResponse2);
        return view('covid.index', compact('response', 'dayone'));
    }
    public function filterByCountry(Request $request){
        $jsonResponse = Http::get('https://api.covid19api.com/summary');
        $response = json_decode($jsonResponse);
        // $jsonResponse -> json(): array|mixed;
        $jsonResponse2 = Http::get('https://api.covid19api.com/dayone/country/mongolia');
        $dayone = json_decode($jsonResponse2);
        if($request->ajax()){
            $jsonResponse3 = Http::get('https://api.covid19api.com/dayone/country/'.$request->slug);
            $dayone = json_decode($jsonResponse3);
            return response()->json(['dayone' => $dayone, 'response' => $response]);
            // return view('covid.index', compact('response', 'dayone'));
        }
        return view('covid.index', compact('response', 'dayone'));
        
    }
}
