<?php

    /**************************************
    * 프로젝트명 : commanine
    * 디렉토리   : app/Http/Controllers
    * 파일명     : ReseachController.php
    * 이력       : 0616 KMH new
    * *********************************** */ 

namespace App\Http\Controllers;

use App\Models\Hanoks;
use Illuminate\Http\Request;

class ResearchController extends Controller
{
    // public function researchPage(){
    //     return view('research');
    // }

    // 0616 BYJ
    public function researchPage(Request $req) {
        // $search_text = $_GET['query'];
        // $hanoks = Hanoks::where('hanok_name', '%'.$search_text.'%')->get();

        // $search_text = $req->search;
        // $searches = Hanoks::search($search_text);

        // return view('research', compact(['searches', 'search_text']));

        if (request('search')) {
            $hanok = Hanoks::where('name', 'like', '%' . request('search') . '%')->get();
        } else {
            $hanok = Hanoks::all();
        }

        return view('research')->with('hanok', $hanok);
        
        
        // $search = $req['search'] ?? "";
        // if ($search != "") {
        //     //where
        //     $hanok = Hanoks::where('hanok_name','=', $search)->get();
        // } else {
        //     $hanok = Hanoks::all();
        // }
        // $data = compact('hanoks','search');
        // return view('research')->with($data);
    }
}