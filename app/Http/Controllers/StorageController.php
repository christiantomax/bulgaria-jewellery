<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\sdMasterzalloc;
use App\Models\sdMasterarticle;
use Carbon\Carbon;

class StorageController extends Controller
{
    public function index(){
        $allocModel = new sdMasterzalloc;
        $artModel = new sdMasterarticle;
        $datatype = [
            'datatype' => $allocModel->getType(),
            'tanggal' => Carbon::now()->isoFormat('dddd, D MMM Y'),
            'summary' => $allocModel->getSummary("all"),
            'article' => $artModel->getArticleByAlloc("all"),
            'post' => '', 
        ];
        return view('article/v_storage', $datatype);
    }

    public function indexPost(Request $req){
        $allocModel = new sdMasterzalloc;
        $artModel = new sdMasterarticle;
        $datatype = [
            'datatype' => $allocModel->getType(),
            'tanggal' => Carbon::now()->isoFormat('dddd, D MMM Y'),
            'summary' => $allocModel->getSummary($req['storage']),
            'article' => $artModel->getArticleByAlloc($req['storage']),
            'post' => $req,
        ];
        return view('article/v_storage', $datatype);
    }
}
