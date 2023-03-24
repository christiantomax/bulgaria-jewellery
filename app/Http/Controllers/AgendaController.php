<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\sdAgenda;
use App\Models\sdNoseries;
use App\Models\sdTrxpo;
use App\Models\sdMasterzalloc;
use Illuminate\Support\Facades\Auth;;
use Carbon\Carbon;

class AgendaController extends Controller
{
    public function index(){
        $poModel = new sdTrxpo;
        $allocModel = new sdMasterzalloc;
        $noseries = new sdNoseries;
        $data = [
            'dataarticletype' => $poModel->getArticleType(),
            'datasupplier' => $poModel->getSuppliers(),
            'tanggal' => Carbon::now()->isoFormat('dddd, D MMM Y'),
            'tanggalagenda' => Carbon::now()->isoFormat('DD/MM/YYYY'),
            'dataallocation' => $allocModel->getTypePo(),
            'idpo' => $noseries->returnNoPO("PO"),
        ];
        return view('dashboard/v_agenda',$data);
    }

    public function createagenda(Request $request){
        try {
            $noseries = new sdNoseries;
            $idagenda = $noseries->returnNoAgenda('AG');
            $id = $noseries->returnUserId();

            $tanggal = explode("/",$request->TglMulai);

            $agenda = new sdAgenda;
            $agenda->IDAgenda = $idagenda;
            $agenda->TglMulai = $tanggal[2]."-".$tanggal[1]."-".$tanggal[0];
            $agenda->JudulAgenda = $request->JudulAgenda;
            $agenda->NoteAgenda = $request->NoteAgenda;
            $agenda->Status = $request->Status;
            $agenda->IDUser = $id;
            $agenda->updated_at = null;
            
            $agenda->save();

            return "Berhasil";
        } catch (\Exception $e) {
            return $e->getMessage();
            return "error";
        }
    }

    public function getagenda(){
        return sdAgenda::whereNull('updated_at')->get();
    }

    public function getagendabyid(Request $request){
        return sdAgenda::where('id', '=', $request->id)->get();
    }

    public function agendadelete(Request $request){
        try {
            sdAgenda::where('id', $request->id)->update(array('updated_at' => now()));
            return "Berhasil";
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function agendaupdate(Request $request){
        try {
            $noseries = new sdNoseries;
            $idagenda = $noseries->returnNoAgenda('AG');
            $id = $noseries->returnUserId();

            $agenda = new sdAgenda;
            $agenda->IDAgenda = $idagenda;
            $agenda->TglMulai = $request->TglMulai;
            $agenda->JudulAgenda = $request->JudulAgenda;
            $agenda->NoteAgenda = $request->NoteAgenda;
            $agenda->Status = $request->Status;
            $agenda->IDUser = $id;
            $agenda->updated_at = null;
            
            $agenda->save();

            sdAgenda::where('id', $request->id)->update(array('updated_at' => now()));

            return "Berhasil";
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
