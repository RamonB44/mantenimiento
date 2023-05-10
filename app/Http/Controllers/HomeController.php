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
                return redirect()->route('jefe.programacion-por-cultivo');
            }else if($user->hasRole('supervisor')){
                return redirect()->route('supervisor.programacion-de-tractores');
            }else if($user->hasRole('asistente')){
                return redirect()->route('asistente.programacion-de-tractores');
            }else if($user->hasRole('operario')){
                return redirect()->route('operario.solicitar-articulos');
            }else if($user->hasRole('planificador')){
                return redirect()->route('planificador.validar-solicitud-de-articulos');
            }else{
                return view('dashboard');
            }
        }
    }
}
