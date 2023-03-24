<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function index(){
        $user = Auth::user()->NamaUser;
        return view('v_dashboard');
    }
}
