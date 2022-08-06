<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StsLoginPenjualController extends Controller
{
    public function StatusLoginPenjual(Request $request){
        
        $login = ['status' => $request->status];

        if($login[0] = null){
            $login = "false";
        }


        return $login;
    }

    
}
