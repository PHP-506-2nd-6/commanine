<?php

    /**************************************
    * 프로젝트명 : commanine
    * 디렉토리   : app/Http/Controllers
    * 파일명     : ReseachController.php
    * 이력       : 0616 KMH new
    * *********************************** */ 

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResearchController extends Controller
{
    public function researchPage(){
        return view('research');
    }
}
