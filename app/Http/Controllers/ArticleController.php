<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\sdArticletype;
use App\Models\sdMasterarticle;
use App\Models\sdMasterarticleimage;
use App\Models\sdMasterzalloc;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use PDF;
use Dompdf\Options;

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
                'datapo' => DB::select("SELECT a.*, po.KodeBarangSupplier FROM sd_masterarticles a
                                    LEFT JOIN sd_trxpos po ON a.IDArticle = po.IDArticle
                                    WHERE a.KodeArticle = '".$kodeart."' "),
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
                $this->correctImageOrientation(storage_path('app/public/uploads/purchaseorder/'.$imageName));
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
        
        $pdf = PDF::loadView('print.article', $data)->setPaper(array(0,0,85.0394,212.598), 'landscape');
        $pdf->render();
        return $pdf->stream();
        // return view('print.article', $data);
        // return asset("template/dist/css/arial.TTF");
        // return view('article/v_article_print', $data);
    }

    function correctImageOrientation($filename) {
        if (function_exists('exif_read_data')) {
            $exif = exif_read_data($filename);
            if($exif && isset($exif['Orientation'])) {
            $orientation = $exif['Orientation'];
            if($orientation != 1){
                $img = imagecreatefromjpeg($filename);
                $deg = 0;
                switch ($orientation) {
                case 3:
                    $deg = 180;
                    break;
                case 6:
                    $deg = 270;
                    break;
                case 8:
                    $deg = 90;
                    break;
                }
                if ($deg) {
                $img = imagerotate($img, $deg, 0);        
                }
                // then rewrite the rotated image back to the disk as $filename 
                imagejpeg($img, $filename, 95);
            } // if there is some rotation necessary
            } // if have the exif orientation info
        } // if function exists      
    }
}
