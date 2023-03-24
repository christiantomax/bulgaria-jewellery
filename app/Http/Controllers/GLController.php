<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\sdTrxso;
use Carbon\Carbon;

class GLController extends Controller
{
    public function index(){
        $data = [
            'tanggal' => Carbon::now()->isoFormat('dddd, D MMM Y'),
            'datagl' => '',
            'post' => '',
        ];
        return view('gl/v_gl', $data);
    }

    public function indexGLPost(Request $req){
        $soModel = new sdTrxso;
        $data = [
            'tanggal' => Carbon::now()->isoFormat('dddd, D MMM Y'),
            'datagl' => $soModel->cekGL($req->date1, $req->date2),
            'post' => $req,
        ];
        return view('gl/v_gl', $data);
    }
}
