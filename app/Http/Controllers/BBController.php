<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\sdMastercustomer;
use App\Models\sdMasterarticle;
use App\Models\sdTrxBuyBack;
use App\Models\sdTrxso;
use Carbon\Carbon;

class BBController extends Controller
{
    public function index(){
        $userModel = new User;
        $bbModel = new sdTrxBuyBack;
        $databb = [
            'user' => $userModel->getUserAll(),
            'databb' => '',
            'tanggal' => Carbon::now()->isoFormat('dddd, D MMM Y'),
            'req' => '',
        ];
        return view('transaction/v_buyback', $databb);
    }

    public function indexPostBB(Request $req){
        $userModel = new User;
        $bbModel = new sdTrxBuyBack;
        $databb = [
            'user' => $userModel->getUserAll(),
            'databb' => $bbModel->getBBFilter($req['bbno'], $req['bbdate1'], $req['bbdate2'],
                        $req['customer'], $req['creator'], $req['status'], $req['article']),
            'tanggal' => Carbon::now()->isoFormat('dddd, D MMM Y'),
            'req' => $req,
        ];
        return view('transaction/v_buyback', $databb);
    }

    public function updateBB($idbb){
        $bbModel = new sdTrxBuyBack;
        $data = $bbModel->getBBByID($idbb);

        if(count($data) == 0)
            return redirect('/buyback');

        $databb = [
            'databb' => $data[0],
            'tanggal' => Carbon::now()->isoFormat('dddd, D MMM Y'),
        ];
        return view('transaction/v_buyback_update', $databb);
    }

    public function updateBBPost(Request $req){
        $bbModel = new sdTrxBuyBack;
        return $bbModel->updateBB($req);
    }

    public function createBB(){
        $custModel = new sdMastercustomer;
        $artModel = new sdMasterarticle;
        $data = [
            'tanggal' => Carbon::now()->isoFormat('dddd, D MMM Y'),
            'tanggalbb' => Carbon::now()->isoFormat('DD/MM/YYYY'),
            'customer' => $custModel->getCustomer(),
        ];
        return view('transaction/v_buyback_create', $data);
    }

    public function BBgetSO(Request $req){
        $soModel = new sdTrxso;
        return $soModel->getSOByKode($req->kode);
    }

    public function getArticle(Request $req){
        $artModel = new sdMasterarticle;
        return $artModel->getArticleByCodeBB($req['kode']);
    }

    public function createBBPost(Request $req){
        $bbModel = new sdTrxBuyBack;
        return $bbModel->createBB($req);
    }
}
