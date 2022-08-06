<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StsLoginPenjualController extends Controller
{
    public function StatusLoginPenjual(Request $request){
        
        $login = $request->status;

        if($login != "true"){
            $login = "false";
        }


        return $login;
    }

    
}
