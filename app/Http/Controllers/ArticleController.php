<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\sdArticletype;
use App\Models\sdMasterarticle;
use App\Models\sdMasterarticleimage;
use App\Models\sdMasterzalloc;
use Carbon\Carbon;

class ArticleController extends Controller
{
    public function index(){
        $artypeModel = new sdArticletype;
        $data = [
            'datatype' => $artypeModel->getType(),
            'tanggal' => Carbon::now()->isoFormat('dddd, D MMM Y'),
        ];
        return view('general/v_articletype', $data);
    }

    public function indexlist(){
        $artModel = new sdMasterarticle;
        $artypeModel = new sdArticletype;
        
        $data = [
            'datartype' => $artypeModel->getType(),
            'article' => $artModel->getArticleByType(1),
            'tanggal' => Carbon::now()->isoFormat('dddd, D MMM Y'),
            'idtype' => '',
        ];
        return view('article/v_articlelist', $data);
    }

    public function articleListPost(Request $req){
        $artModel = new sdMasterarticle;
        $artypeModel = new sdArticletype;
        
        $data = [
            'datartype' => $artypeModel->getType(),
            'article' => $artModel->getArticleByType($req->artype),
            'tanggal' => Carbon::now()->isoFormat('dddd, D MMM Y'),
            'idtype' => $req->artype,
        ];
        return view('article/v_articlelist', $data);
    }

    public function updateArType($kodetype){
        $artypeModel = new sdArticletype;
        $datatype = $artypeModel->getTypeByCodeByIDArticleType($kodetype);
        if(count($datatype) != 0 ){
            $data = [
                'datatype' => $datatype[0],
                'tanggal' => Carbon::now()->isoFormat('dddd, D MMM Y'),
            ];
            return view('general/v_articletype_update', $data);
        }
        return redirect('/article/type');
    }

    public function createArType(Request $req){
        $artypeModel = new sdArticletype;
        return $artypeModel->createArType($req);
    }

    public function delArType(Request $req){
        $artypeModel = new sdArticletype;
        return $artypeModel->delArType($req);
    }

    public function updateArTypePost(Request $req){
        $artypeModel = new sdArticletype;
        return $artypeModel->updateArType($req);
    }

    public function updateArt($kodeart){
        $artModel = new sdMasterarticle;
        $artypeModel = new sdArticletype;
        $allocModel = new sdMasterzalloc;

        $datart = $artModel->getArticleByCode($kodeart);
        $datartype = $artypeModel->getType();
        $dataralloc = $allocModel->getType();

        if(count($datart) != 0){
            $data = [
                'datart' => $datart[0],
                'datartype' => $datartype,
                'datalloc' => $dataralloc,
                'tanggal' => Carbon::now()->isoFormat('dddd, D MMM Y'),
            ];
            return view('article/v_article_update', $data);
        }
        return redirect('/storages');
    }

    public function updateArtPost(Request $req){
        try{
            $artImageModel = new sdMasterarticleimage();
            $artModel = new sdMasterarticle;
            $artModel->updateArticle($req);

            if ($req->file('file')) {
                $imagePath = $req->file('file');
                $imageName = $req->kode.".".$imagePath->extension();
                $path = $req->file('file')->storeAs('uploads/purchaseorder', $req->kode.".".$imagePath->extension(), 'public');
                $artImageModel->articleImage($req->id, $imageName, '/storage/'.$path);
            }
            else{
                return "failimage";
            }
            return "Berhasil";
        } catch (\Exception $e) {
            return "error";
            // return $e->getMessage();
        }
    }

    public function printArtKode(Request $req){
        $artypeModel = new sdMasterarticle;
        $datart = $artypeModel->getArticleByCode($req->kode);
        $data = [
            'article' => $datart[0],
        ];
        return view('article/v_article_print', $data);
    }
}
