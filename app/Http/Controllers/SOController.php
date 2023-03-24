<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\sdArticletype;
use App\Models\sdMastercustomer;
use App\Models\sdMasterarticle;
use App\Models\sdTrxso;
use Carbon\Carbon;

class SOController extends Controller
{
    public function index(){
        $userModel = new User;
        $soModel = new sdTrxso;
        $dataso = [
            'user' => $userModel->getUserAll(),
            'dataso' => '',
            'tanggal' => Carbon::now()->isoFormat('dddd, D MMM Y'),
            'req' => '',
        ];
        return view('transaction/v_so', $dataso);
    }

    public function indexPostSo(Request $req){
        $userModel = new User;
        $soModel = new sdTrxso;
        $dataso = [
            'user' => $userModel->getUserAll(),
            'dataso' => $soModel->getSOFilter($req['sono'], $req['sodate1'], $req['sodate2'],
                    $req['customer'], $req['creator'], $req['updater'], $req['status'], $req['article']),
            'tanggal' => Carbon::now()->isoFormat('dddd, D MMM Y'),
            'req' => $req,
        ];
        return view('transaction/v_so', $dataso);
    }

    public function updateSO($idso){
        $soModel = new sdTrxso;
        $data = $soModel->getSOByID($idso);

        if(count($data) == 0)
            return redirect('/transaction/sales');

        $dataso = [
            'dataso' => $data[0],
            'tanggal' => Carbon::now()->isoFormat('dddd, D MMM Y'),
        ];
        return view('transaction/v_so_update', $dataso);
    }

    public function updateSOPost(Request $req){
        $soModel = new sdTrxso;
        return $soModel->updateSO($req);
    }

    public function printSertif(Request $req){
        $soModel = new sdTrxso;
        $dataso = [
            'dataso' => $soModel->getSOByKode($req['nososertif']),
        ];
        return view('transaction/v_sertif', $dataso);
    }

    public function printInv(Request $req){
        $soModel = new sdTrxso;
        $dataso = [
            'dataso' => $soModel->getSOByKode($req['nosoinv']),
        ];
        return view('transaction/v_invoice', $dataso);
    }

    public function createSO(){
        $custModel = new sdMastercustomer;
        $dataso = [
            'tanggal' => Carbon::now()->isoFormat('dddd, D MMM Y'),
            'tanggalso' => Carbon::now()->isoFormat('DD/MM/YYYY'),
            'customer' => $custModel->getCustomer(),
        ];
        return view('transaction/v_so_create', $dataso);
    }

    public function SOGetArticle(Request $req){
        $artModel = new sdMasterarticle;
        return $artModel->getArticleReady($req->idtype);
    }

    public function createSOPost(Request $req){
        $soModel = new sdTrxso;
        return $soModel->createSO($req);
    }

    public function getArticle(Request $req){
        $artModel = new sdMasterarticle;
        return $artModel->getArticleByCodeSO($req['kode']);
    }

    public function getCust(Request $req){
        $custModel = new sdMastercustomer;
        return $custModel->getCustomerByCode($req['kode']);
    }
}
