<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GlobalFunctionController extends Controller
{
    public function documentation(){
        return redirect('api/docs');
    }
}
