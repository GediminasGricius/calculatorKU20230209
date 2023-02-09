<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalculatorController extends Controller
{
    public function showForm(){
        return view("calculator.form");
    }

    public function showResult(Request $request ){
        $x=$request->x;
        $y=$request->y;
        $r=$x * $y;
        return view("calculator.result", [
            'result'=>$r
        ]);
    }
}
