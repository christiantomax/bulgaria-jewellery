<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\sdPassword;

class LoginController extends Controller
{
    public function index(){
        return view('v_login');
    }

    public function authenticate(Request $req){
        $credentials = $req->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt(['username' => $credentials['username'], 'password' => $credentials['password'], 'Status' => 1])) {
            // Cek Password Default
            $defpass = new sdPassword;
            $pass = $defpass->getPass();
            if($credentials['password'] == $pass[0]->DefaultPassword){
                return redirect('/changepass');
            }

            $req->session()->regenerate();
            return redirect('/dashboard');
        }

        return back()->with('loginError','Login failed!');
    }

    public function changepass(){
        return view('v_changepass')->with('kode');
    }

    public function changepasspost(Request $req){
        $credentials = $req->validate([
            'password1' => ['required'],
            'password2' => ['required'],
        ]);

        if($credentials['password1'] == $credentials['password2']){
            $defpass = new sdPassword;
            $pas = $defpass->changePass(bcrypt($credentials['password1']));
            return $this->logout();
        }

        return back()->with('Error','Password not match!');
    }

    public function logout(){
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/login');
    }
}
