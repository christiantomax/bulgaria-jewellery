<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\sdTrxco;

class LogController extends Controller
{
    public function indexlogco(){
        $coModel = new sdTrxco;
        $datacustomer = [
            'datacustomer' => $coModel->getallco(),
        ];
        return view('log/v_log_customorder', $datacustomer);
    }

    public function viewidco($idco){
        $Model = new sdTrxco;
        $data = $Model->getDetailByIDCO($idco);
        if(count($datatype) != 0 ){
            $data = [
                'datatype' => $datatype[0],
            ];
            return view('log/v_log_customorderdetail', $data);
        }
        return redirect('/log/co');
    }

    // public function createCustomer(Request $req){
    //     $customerModel = new sdMastercustomer;
    //     return $customerModel->createCustomer($req);
    // }

    // public function updateCustomer($kodecustomer){
    //     $customerModel = new sdMastercustomer;
    //     $datacustomer = $customerModel->getCustomerByCode($kodecustomer);
    //     if(count($datacustomer) != 0 ){
    //         $data = [
    //             'datacustomer' => $datacustomer[0],
    //         ];
    //         return view('/master/v_customer_update', $data);
    //     }
    //     return view('/master/v_customer_update');
    // }

    // public function updateCustomerPost(Request $req){
    //     $customerModel = new sdMastercustomer;
    //     return $customerModel->updateCustomer($req);
    // }

    // public function delCustomer(Request $req){
    //     $customerModel = new sdMastercustomer;
    //     return $customerModel->delCustomer($req);
    // }
}
