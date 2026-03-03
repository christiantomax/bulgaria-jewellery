<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\sdTrxpo;
use App\Models\sdMasterarticleimage;
use App\Models\sdMasterzalloc;
use App\Models\sdMasterarticle;
use App\Models\sdNoseries;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Carbon\Carbon;

class PoController extends Controller
{
    public function index(){
        $userModel = new User;
        $poModel = new sdTrxpo();
        $datapo = [
            'user' => $userModel->getUserAll(),
            'datapo' => $poModel->getPOnow(),
            'tanggal' => Carbon::now()->isoFormat('dddd, D MMM Y'),
            'datasupplier' => $poModel->getSuppliers(),
            'req' => '',
        ];
        return view('transaction/v_purchase_order', $datapo);
    }

    public function createpoview(){
        date_default_timezone_set("Asia/Jakarta");
        $poModel = new sdTrxpo;
        $noseries = new sdNoseries;
        $data = [
            'dataarticletype' => $poModel->getArticleType(),
            'datasupplier' => $poModel->getSuppliers(),
            'datatanggal' => Carbon::now()->isoFormat('dddd, D MMM Y'),
            'idpo' => $noseries->returnNoPO("PO"),
        ];
        return view('transaction/v_purchase_order_create',$data);
    }

    public function detailpo($request){
        $poModel = new sdTrxpo;
        $data = [
            'datapoheader' => $poModel->getPODetailHeader($request),
            'datapodetail' => $poModel->getPODetail($request),
            'datatanggal' => Carbon::now()->isoFormat('dddd, D MMM Y'),
        ];
        return view('transaction/v_purchase_order_detail',$data);
    }

    public function getpofilter(Request $request){
        $poModel = new sdTrxpo;
        return $poModel->getPOfilter($request);
    }

    public function createpo(Request $request){
        $path = null;
        try {
            $idpo = $request->idpo;
            $noseries = new sdNoseries;
            $id = $noseries->returnUserId();

            DB::beginTransaction();

            $ArticleModel = new sdMasterarticle;
            $namafile = $ArticleModel->createArticleMaster($request);
            if($namafile === 'error'){
                throw new \Exception('Gagal membuat master article');
            }
            $idarticle = $ArticleModel->getArticleByKodeArticle($namafile);
            if(count($idarticle) == 0){
                throw new \Exception('Article tidak ditemukan setelah create');
            }

            $image = new sdMasterarticleimage;
            if ($request->file('file')) {
                $imagePath = $request->file('file');
                $maxTry = 50;
                $counterTry = 0;
                do {
                    $counterTry++;
                    $imageName = $noseries->returnNoByKode("POI", "POI (Purchase Order Image)").".".$imagePath->extension();
                    $path = "uploads/purchaseorder/".$imageName;
                    if($counterTry > $maxTry){
                        throw new \Exception('Tidak bisa mendapatkan nama image unik dari no series');
                    }
                } while(Storage::disk('public')->exists($path));

                $request->file('file')->storeAs('uploads/purchaseorder', $imageName, 'public');
            }
            else{
                throw new \Exception('File image wajib diisi');
            }

            $image->IDArticle = $idarticle[0]->IDArticle;
            $image->Name = $imageName;
            $image->Path = '/storage/'.$path;
            $image->Note = '';
            $image->IDUser = $id;
            $image->updated_at = null;
            
            $image->save();

            $tanggal = explode("/",$request->tanggaljatuhtempo);
            
            $purchaseorder = new sdTrxpo;
            $purchaseorder->IDPO = $idpo;
            $purchaseorder->IDSupplier = $request->idsupplier;
            $purchaseorder->IDArticle = $idarticle[0]->IDArticle;
            $purchaseorder->Harga = $request->articlepurchaseprice;
            $purchaseorder->ExchangeRate = $request->exchangerate;
            
            if($tanggal[0] == ''){
                $purchaseorder->TglJatuhTempo = null;
            }else{
                $purchaseorder->TglJatuhTempo = $tanggal[2]."-".$tanggal[1]."-".$tanggal[0];
            }
            $purchaseorder->Note = '';
            $purchaseorder->IDUser = $id;
            $purchaseorder->updated_at = null;
            $purchaseorder->NotaSupplier = $request->notasupplier;
            $purchaseorder->KodeBarangSupplier = $request->kodebarangsupplier;
            
            $purchaseorder->save();

            DB::commit();
            return 'berhasil';

        } catch (\Exception $e) {
            DB::rollBack();
            if($path){
                Storage::disk('public')->delete($path);
            }
            Log::error('Create PO gagal', [
                'idpo' => $request->idpo,
                'idsupplier' => $request->idsupplier,
                'message' => $e->getMessage(),
            ]);
            return "error";
        }

    }

    
}
