<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LogoutController extends Controller
{
    //
    public function logout(){
        
        Session::flush(); // Eliminar variables de sesion
        
        Auth::logout();
        return redirect()->route('login');
    }

}
