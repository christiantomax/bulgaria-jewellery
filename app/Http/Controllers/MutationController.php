<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\sdArticletype;
use App\Models\sdMasterarticle;
use App\Models\sdMasterzalloc;
use App\Models\sdMutation;
use App\Models\sdTrxso;
use Carbon\Carbon;

class MutationController extends Controller
{
    public function index(){
        $allocModel = new sdMasterzalloc;
        $artModel = new sdMasterarticle;
        $artypeModel = new sdArticletype;
        $mutModel = new sdMutation;

        $data = [
            'alloc' => $allocModel->getType(),
            'artype' => $artypeModel->getType(),
            'article' => $artModel->getArticleByType(1),
            'mutationlist' => $mutModel->getMutationList("",""),
            'tanggal' => Carbon::now()->isoFormat('dddd, D MMM Y'),
            'post' => '',
        ];

        return view('article/v_mutation', $data);
    }

    public function mutationGetArticle(Request $req){
        $artModel = new sdMasterarticle;
        return $artModel->getArticleByType($req->idtype);
    }

    public function mutationGetArticleDet(Request $req){
        $artModel = new sdMasterarticle;
        return $artModel->getArticleByCode($req['kode']);
    }

    public function mutationPost(Request $req){
        $allocModel = new sdMasterzalloc;
        $artModel = new sdMasterarticle;
        $mutModel = new sdMutation;
        $soModel = new sdTrxso;

        // Dicek sudah ada SO aktif nya belum
        if($req['from'] == 4)
            return "so";

        $from = $allocModel->getTypeByID($req['from']);
        $to = $allocModel->getTypeByID($req['to']);
        $art = $artModel->getArticleByCode($req['article']);
        return $mutModel->createMutation('-', $art[0]->IDArticle, $art[0]->KodeArticle, $art[0]->NamaArticle,
                $from[0]->IDZAlloc, $from[0]->KodeAlloc.' - '.$from[0]->NamaAlloc,
                $to[0]->IDZAlloc, $to[0]->KodeAlloc.' - '.$to[0]->NamaAlloc, $req['note']);
        
        // Dicek sudah ada SO aktif nya belum
        // if($soModel->cekArticleInSO($art[0]->IDArticle) == "null")
        //     return $mutModel->createMutation('-', $art[0]->IDArticle, $art[0]->KodeArticle, $art[0]->NamaArticle,
        //             $from[0]->IDZAlloc, $from[0]->KodeAlloc.' - '.$from[0]->NamaAlloc,
        //             $to[0]->IDZAlloc, $to[0]->KodeAlloc.' - '.$to[0]->NamaAlloc, $req['note']);
        // return "so";
    }

    public function mutationFilter(Request $req){
        $allocModel = new sdMasterzalloc;
        $artModel = new sdMasterarticle;
        $artypeModel = new sdArticletype;
        $mutModel = new sdMutation;
        $data = [
            'alloc' => $allocModel->getType(),
            'artype' => $artypeModel->getType(),
            'article' => $artModel->getArticleByType(1),
            'mutationlist' => $mutModel->getMutationList($req['date1'], $req['date2']),
            'tanggal' => Carbon::now()->isoFormat('dddd, D MMM Y'),
            'post' => $req,
        ];

        return view('article/v_mutation', $data);
    }
}
