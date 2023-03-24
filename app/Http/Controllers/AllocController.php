<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\sdMasterzalloc;
use Carbon\Carbon;

class AllocController extends Controller
{
    public function index(){
        $allocModel = new sdMasterzalloc;
        $data = [
            'datatype' => $allocModel->getType(),
            'tanggal' => Carbon::now()->isoFormat('dddd, D MMM Y'),
        ];
        return view('general/v_allocation', $data);
    }

    public function updateAlloc($kodealloc){
        $allocModel = new sdMasterzalloc;
        $datatype = $allocModel->getTypeByCode($kodealloc);
        if(count($datatype) != 0 ){
            $data = [
                'datatype' => $datatype[0],
                'tanggal' => Carbon::now()->isoFormat('dddd, D MMM Y'),
            ];
            return view('general/v_allocation_update', $data);
        }
        return redirect('/allocation/setup');
    }

    public function updateAllocPost(Request $req){
        $allocModel = new sdMasterzalloc;
        return $allocModel->updateAlloc($req);
    }

    public function createAlloc(Request $req){
        $allocModel = new sdMasterzalloc;
        return $allocModel->createAlloc($req);
    }

    public function delAlloc(Request $req){
        $allocModel = new sdMasterzalloc;
        return $allocModel->delAlloc($req);
    }
}
