<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\sdTrxco;
use App\Models\sdTrxcoimage;
use App\Models\sdMasterzalloc;
use App\Models\sdMasterarticle;
use App\Models\sdNoseries;
use App\Models\User;
use Carbon\Carbon;

class CoController extends Controller
{
    public function index(){
        $userModel = new User;
        $coModel = new sdTrxco();
        $dataco = [
            'user' => $userModel->getUserAll(),
            'dataco' => $coModel->getCOnow(),
            'datacustomer' => $coModel->getCustomer(),
            'tanggal' => Carbon::now()->isoFormat('dddd, D MMM Y'),
            'req' => '',
        ];
        return view('transaction/v_custom_order', $dataco);
    }

    public function detailco($request){
        $coModel = new sdTrxco;
        $data = [
            'datacoheader' => $coModel->getCODetailHeader($request),
            'datacodetail' => $coModel->getCODetail($request),
            'datatanggal' => Carbon::now()->isoFormat('dddd, D MMM Y'),
        ];
        return view('transaction/v_custom_order_detail',$data);
    }

    public function getcofilter(Request $request){
        $coModel = new sdTrxco;
        return $coModel->getCOfilter($request);
    }

    public function printcoinv(Request $req){
        $coModel = new sdTrxco;
        $data = [
            'data' => $coModel->getCOByKode($req['nocoid']),
        ];
        return view('transaction/v_custom_order_invoice', $data);
    }

    public function createcoview(){
        date_default_timezone_set("Asia/Jakarta");
        $coModel = new sdTrxco;
        $allocModel = new sdMasterzalloc;
        $noseries = new sdNoseries;
        $data = [
            'datacotype' => $coModel->getCOType(),
            'datacustomer' => $coModel->getCustomer(),
            'datatanggal' => Carbon::now()->isoFormat('dddd, D MMM Y'),
            'dataallocation' => $allocModel->getType(),
            'idco' => $noseries->returnNoCO("CO"),
        ];
        return view('transaction/v_custom_order_create',$data);
    }

    public function createco(Request $request){
        try {
            $feedback = array();
            $idco = $request->idco;
            $noseries = new sdNoseries;
            $id = $noseries->returnUserId();

            $namafile = $noseries->returnNoCOI("COI");

            $image = new sdTrxcoimage;

            if ($request->file('file')) {
                $imagePath = $request->file('file');
                $imageName = $imagePath->getClientOriginalName();

                $path = $request->file('file')->storeAs('uploads/customorder', $namafile.".".$imagePath->extension());
            }
            else{
                $feedback['idpo'] = "error";
                $feedback['articlekode'] = "error";
                return response()->json($feedback);
            }


            $purchaseorder = new sdTrxco;
            $purchaseorder->IDCO = $idco;
            $purchaseorder->IDCustomer = $request->idcustomer;
            $purchaseorder->IDOrderType = $request->customordertype;
            $purchaseorder->HargaFinal = $request->customorderHargaFinal;
            $purchaseorder->Size = $request->customorderSize;
            $purchaseorder->downpayment = $request->downpayment;
            $purchaseorder->Weight = $request->customorderWeight;
            $purchaseorder->MetalType = $request->customorderMetalType;
            $purchaseorder->Quality = $request->customorderQuality;
            $purchaseorder->LaborCost = $request->customorderLaborCost;
            $purchaseorder->GoldPrice = $request->customorderGoldPrice;
            $purchaseorder->TglJatuhTempo = $request->tanggaljatuhtempo;
            $purchaseorder->Note = $request->customorderNote;
            $purchaseorder->IDUser = $id;
            $purchaseorder->updated_at = null;

            $purchaseorder->save();

            $image->IDCO = $purchaseorder->id;
            $image->Name = $namafile.".".$imagePath->extension();
            $image->Path = '/storage/'.$path;
            $image->Note = '';
            $image->IDUser = $id;
            $image->updated_at = null;

            $image->save();

            return "Berhasil";
        } catch (\Exception $e) {
            return $e->getMessage();
            // return "error";
        }
    }


}
