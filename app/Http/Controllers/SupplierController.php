<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\sdMastersupplier;

class SupplierController extends Controller
{
    public function index(){
        $supplierModel = new sdMastersupplier;
        $datasupplier = [
            'datasupplier' => $supplierModel->getsupplier(),
        ];
        return view('master/v_supplier', $datasupplier);
    }

    public function createSupplier(Request $req){
        $supplierModel = new sdMastersupplier;
        return $supplierModel->createsupplier($req);
    }

    public function updateSupplier($kodesupplier){
        $supplierModel = new sdMastersupplier;
        $datasupplier= $supplierModel->getSupplierByCode($kodesupplier);
        if(count($datasupplier) != 0 ){
            $data = [
                'datasupplier' => $datasupplier[0],
            ];
            return view('/master/v_supplier_update', $data);
        }
        return view('/master/v_supplier');
    }

    public function updateSupplierPost(Request $req){
        $supplierModel = new sdMastersupplier;
        return $supplierModel->updateSupplier($req);
    }

    public function delSupplier(Request $req){
        $supplierModel = new sdMastersupplier;
        return $supplierModel->delSupplier($req);
    }
}
