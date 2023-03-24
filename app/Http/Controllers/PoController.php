<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\sdTrxpo;
use App\Models\sdMasterarticleimage;
use App\Models\sdMasterzalloc;
use App\Models\sdMasterarticle;
use App\Models\sdNoseries;
use Illuminate\Support\Facades\Auth;
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
        try {
            $feedback = array();
            $idpo = $request->idpo;
            $noseries = new sdNoseries;
            $id = $noseries->returnUserId();

            $ArticleModel = new sdMasterarticle;
            $namafile = $ArticleModel->createArticleMaster($request);
            $idarticle = $ArticleModel->getArticleByKodeArticle($namafile);

            $image = new sdMasterarticleimage;
            if ($request->file('file')) {
                $imagePath = $request->file('file');
                $imageName = $imagePath->getClientOriginalName();

                $path = $request->file('file')->storeAs('uploads/purchaseorder', $namafile.".".$imagePath->extension(), 'public');
            }
            else{
                $feedback['idpo'] = "error";
                $feedback['articlekode'] = "error";
                return response()->json($feedback);
            }

            $image->IDArticle = $idarticle[0]->IDArticle;
            $image->Name = $namafile.".".$imagePath->extension();
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
                $purchaseorder->TglJatuhTempo = '';
            }else{
                $purchaseorder->TglJatuhTempo = $tanggal[2]."-".$tanggal[1]."-".$tanggal[0];
            }
            $purchaseorder->Note = '';
            $purchaseorder->IDUser = $id;
            $purchaseorder->updated_at = null;
            $purchaseorder->NotaSupplier = $request->notasupplier;
            $purchaseorder->KodeBarangSupplier = $request->kodebarangsupplier;
            
            $purchaseorder->save();

            return 'berhasil';

        } catch (\Exception $e) {
            return $e->getMessage();
            return "error";
        }

    }

    
}
