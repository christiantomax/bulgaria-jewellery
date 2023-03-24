<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\sdMastercustomer;
use Carbon\Carbon;

class CustomerController extends Controller
{
    public function index(){
        $customerModel = new sdMastercustomer;
        $datacustomer = [
            'datacustomer' => $customerModel->getCustomer(),
        ];
        return view('master/v_customer', $datacustomer);
    }

    public function createCustomer(Request $req){
        $customerModel = new sdMastercustomer;
        return $customerModel->createCustomer($req);
    }

    public function updateCustomer($idc){
        $customerModel = new sdMastercustomer;
        $datacustomer = $customerModel->getCustomerByID($idc);
        if(count($datacustomer) != 0 ){
            $data = [
                'datacustomer' => $datacustomer[0],
            ];
            return view('/master/v_customer_update', $data);
        }
        return view('/master/v_customer_update');
    }

    public function updateCustomerPost(Request $req){
        $customerModel = new sdMastercustomer;
        return $customerModel->updateCustomer($req);
    }

    public function delCustomer(Request $req){
        $customerModel = new sdMastercustomer;
        return $customerModel->delCustomer($req);
    }
}
