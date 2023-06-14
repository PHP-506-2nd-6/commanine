<?php

namespace App\Http\Controllers;

use App\Models\Hanoks;
use Illuminate\Http\Request;

class HanoksController extends Controller
{
    public function hanoksDetail($id) {
        $hanoks = Hanoks::find($id);
        return view('detail')->with('data', $hanoks);
    }
}
