<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;
use App\Models\sdMasterarticle;

class PDFController extends Controller
{
    public function generatePDFSO(Request $request)
    {
        $so = DB::select("SELECT sd_trxsos.KodeSO, sd_trxsos.NamaUserCreator, sd_mastercustomers.Nama, sd_mastercustomers.Telepon, sd_masterarticles.*, sd_masterarticleimages.Path, sd_trxsos.HargaFinal
        FROM sd_trxsos, sd_masterarticles, sd_masterarticleimages, sd_mastercustomers WHERE
        sd_trxsos.IDArticle = sd_masterarticles.IDArticle AND
        sd_masterarticles.IDArticle = sd_masterarticleimages.id AND
        sd_mastercustomers.IDCustomer = sd_trxsos.IDCustomer AND
        sd_trxsos.KodeSO = '".$request->kodeSO."'");

        if (count($so) == 1) {
            $so = $so[0];
            $time = strtotime($so->created_at);
            $so->created_at = date('d M Y',$time);
            $so->HargaFinalTerbilang = $this->terbilang($so->HargaFinal)." Rupiah";
            $so->HargaFinal = 'Rp. '.strrev(implode('.',str_split(strrev(strval($so->HargaFinal)),3))).',00';
            $data = [
                'data' => $so
            ];
            // return view('print.SO', $data);
            $pdf = PDF::loadView('print.SO', $data)->setPaper('a5', 'landscape');
            $pdf->render();
            return $pdf->stream();
        }else {
            return "unknown ID or something went wrong";
        }
    }

    public function generatePDFTNC()
    {
        $data = [
            'title' => 'Welcome to ItSolutionStuff.com',
            'date' => date('m/d/Y')
        ];
        // return view('print.TNC');
        $pdf = PDF::loadView('print.TNC', $data)->setPaper('a5', 'landscape');
        $pdf->render();
        return $pdf->stream();
        return $pdf->download('itsolutionstuff.pdf');
    }

    public function generatePDFCertificate(Request $request)
    {
        $data = sdMasterarticle::join('sd_masterarticleimages', 'sd_masterarticleimages.IDArticle', '=', 'sd_masterarticles.IDArticle')
        ->select('sd_masterarticleimages.Path', 'sd_masterarticles.NamaArticle', 'sd_masterarticles.kodeArticle')
        ->where(".KodeArticle", $request['kodeArticle'])
        ->get();
        $data = [
            'data' => $data[0],
        ];

        // return view('print.certificate');
        $pdf = PDF::loadView('print.certificate', $data)->setPaper('a5', 'potrait');
        $pdf->render();
        return $pdf->stream();
    }

    public function generatePDFCO(Request $request)
    {
        $co = DB::select("SELECT users.NamaUser, sd_trxcotypes.NamaJenisType, sd_mastercustomers.Nama, sd_mastercustomers.Telepon, sd_mastercustomers.Alamat,
        sd_mastercustomers.Telepon, sd_mastercustomers.Telepon2, sd_trxcos.*, sd_trxcoimages.Path
        FROM sd_trxcos, sd_trxcotypes, sd_trxcoimages, sd_mastercustomers, users WHERE
        sd_trxcos.IDUser = users.id AND
        sd_trxcos.id = sd_trxcoimages.IDCO AND
        sd_trxcos.IDOrderType = sd_trxcotypes.id AND
        sd_trxcos.IDCustomer = sd_mastercustomers.id AND
        sd_trxcos.IDCO = '".$request->kodeCO."'");
        if (count($co) >= 1) {
            $tempHargaJadi = 0;
            foreach ($co as $value) {
                $tempHargaJadi += $value->HargaFinal;
            }
            $co = $co[0];
            $time = strtotime($co->created_at);
            $co->created_at = date('d M Y',$time);
            $co->downpayment = 'Rp. '.strrev(implode('.',str_split(strrev(strval($co->downpayment)),3))).',00';
            $co->HargaFinal = 'Rp. '.strrev(implode('.',str_split(strrev(strval($co->HargaFinal)),3))).',00';
            $data = [
                'data' => $co,
                'hargaJadi' => 'Rp. '.strrev(implode('.',str_split(strrev(strval($tempHargaJadi)),3))).',00',
                'hargaJadiTerbilang' => $this->terbilang($tempHargaJadi),
            ];
            // return view('print.CO', $data);
            $pdf = PDF::loadView('print.CO', $data)->setPaper('a5', 'landscape');
            $pdf->render();
            return $pdf->stream();
        }else {
            return "unknown ID or something went wrong";
        }
    }

    function penyebut($nilai) {
		$nilai = abs($nilai);
		$huruf = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
		$temp = "";
		if ($nilai < 12) {
			$temp = " ". $huruf[$nilai];
		} else if ($nilai <20) {
			$temp = $this->penyebut($nilai - 10). " Belas";
		} else if ($nilai < 100) {
			$temp = $this->penyebut($nilai/10)." Puluh". $this->penyebut($nilai % 10);
		} else if ($nilai < 200) {
			$temp = " Seratus" . $this->penyebut($nilai - 100);
		} else if ($nilai < 1000) {
			$temp = $this->penyebut($nilai/100) . " Ratus" . $this->penyebut($nilai % 100);
		} else if ($nilai < 2000) {
			$temp = " Seribu" . $this->penyebut($nilai - 1000);
		} else if ($nilai < 1000000) {
			$temp = $this->penyebut($nilai/1000) . " Ribu" . $this->penyebut($nilai % 1000);
		} else if ($nilai < 1000000000) {
			$temp = $this->penyebut($nilai/1000000) . " Juta" . $this->penyebut($nilai % 1000000);
		} else if ($nilai < 1000000000000) {
			$temp = $this->penyebut($nilai/1000000000) . " Milyar" . $this->penyebut(fmod($nilai,1000000000));
		} else if ($nilai < 1000000000000000) {
			$temp = $this->penyebut($nilai/1000000000000) . " Trilyun" . $this->penyebut(fmod($nilai,1000000000000));
		}
		return $temp;
	}

	function terbilang($nilai) {
		if($nilai<0) {
			$hasil = "minus ". trim($this->penyebut($nilai));
		} else {
			$hasil = trim($this->penyebut($nilai));
		}
		return $hasil;
	}

}
