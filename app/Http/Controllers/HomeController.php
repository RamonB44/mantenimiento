<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        if(Auth()->user() == NULL){
            return redirect('login');
        }else{
            $user = User::find(auth()->user()->id);
            if($user->hasRole('jefe')){
                return redirect()->route('jefe');
            }else if($user->hasRole('supervisor')){
                return redirect()->route('supervisor.programacion-tractores');
            }else if($user->hasRole('asistente')){
                return redirect()->route('asistente');
            }else if($user->hasRole('operador')){
                return redirect()->route('operador.solicitar-materiales');
            }else if($user->hasRole('plannficador')){
                return redirect()->route('plannficador.validar-solicitud-de-materiales');
            }else{
                return view('dashboard');
            }
        }
    }
}
