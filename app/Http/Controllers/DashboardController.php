<?php

namespace App\Http\Controllers;
ini_set('memory_limit', '200M');
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Beneficiary;
use App\State;

class DashboardController extends Controller
{
    public function index()
    {

        $all_ben = Beneficiary::get();
        $all_beneficiaries = $all_ben->count();

        // get BAY states individually
        $borno = State::where('id', '8')->get('target');
        $adamawa = State::where('id', '2')->get('target');
        $yobe = State::where('id', '36')->get('target');


        // $borno = $borno[0]->target;
        // $adamawa = $adamawa[0]->target;
        // $yobe = $yobe[0]->target;


        // get beneficiaries per status
        $communities_members = Beneficiary::where('status_id', '1')->count();
        $idp_members = Beneficiary::where('status_id', '2')->count();
        $returnees = Beneficiary::where('status_id', '3')->count();
        $goverment_officials = Beneficiary::where('status_id', '4')->count();

        // get beneficiaries per status Borno state
        $communities_members_borno = Beneficiary::where(['status_id'=>'1','state_id'=>'8'])->count();
        $idp_members_borno = Beneficiary::where(['status_id'=>'2','state_id'=>'8'])->count();
        $returnees_borno = Beneficiary::where(['status_id'=>'3','state_id'=>'8'])->count();
        $goverment_officials_borno = Beneficiary::where(['status_id'=>'4','state_id'=>'8'])->count();


        // get beneficiaries per status Admawa state
        $communities_members_adamawa = Beneficiary::where(['status_id'=>'1','state_id'=>'2'])->count();
        $idp_members_adamawa = Beneficiary::where(['status_id'=>'2','state_id'=>'2'])->count();
        $returnees_adamawa = Beneficiary::where(['status_id'=>'3','state_id'=>'2'])->count();
        $goverment_officials_adamawa = Beneficiary::where(['status_id'=>'4','state_id'=>'2'])->count();


        // get beneficiaries per status Yobe state
        $communities_members_yobe = Beneficiary::where(['status_id'=>'1','state_id'=>'36'])->count();
        $idp_members_yobe = Beneficiary::where(['status_id'=>'2','state_id'=>'36'])->count();
        $returnees_yobe = Beneficiary::where(['status_id'=>'3','state_id'=>'36'])->count();
        $goverment_officials_yobe = Beneficiary::where(['status_id'=>'4','state_id'=>'36'])->count();

        // get benefirciaries per sate
        $bornoBeneficiaries = Beneficiary::where('state_id', '8')->count();
        $adamawaBeneficiaries = Beneficiary::where('state_id', '2')->count();
        $yobeBeneficiaries = Beneficiary::where('state_id', '36')->count();

        // calculate percentages
        $status1_percentage = $this->get_percentage($communities_members, $all_beneficiaries);
        $status2_percentage = $this->get_percentage($idp_members, $all_beneficiaries);
        $status3_percentage = $this->get_percentage($returnees, $all_beneficiaries);
        $status4_percentage = $this->get_percentage($goverment_officials, $all_beneficiaries);

        // calculate percentages borno state
        $status1_percentage_borno = $this->get_percentage($communities_members_borno, $bornoBeneficiaries);
        $status2_percentage_borno = $this->get_percentage($idp_members_borno, $bornoBeneficiaries);
        $status3_percentage_borno = $this->get_percentage($returnees_borno, $bornoBeneficiaries);
        $status4_percentage_borno = $this->get_percentage($goverment_officials_borno, $bornoBeneficiaries);

        // calculate percentages Adamawa state
        $status1_percentage_adamawa = $this->get_percentage($communities_members_adamawa, $adamawaBeneficiaries);
        $status2_percentage_adamawa = $this->get_percentage($idp_members_adamawa, $adamawaBeneficiaries);
        $status3_percentage_adamawa = $this->get_percentage($returnees_adamawa, $adamawaBeneficiaries);
        $status4_percentage_adamawa = $this->get_percentage($goverment_officials_adamawa, $adamawaBeneficiaries);

        // calculate percentages Yobe state
        $status1_percentage_yobe = $this->get_percentage($communities_members_yobe, $yobeBeneficiaries);
        $status2_percentage_yobe = $this->get_percentage($idp_members_yobe, $yobeBeneficiaries);
        $status3_percentage_yobe = $this->get_percentage($returnees_yobe, $yobeBeneficiaries);
        $status4_percentage_yobe = $this->get_percentage($goverment_officials_yobe, $yobeBeneficiaries);

        return view('dashboard.index', compact(
            'communities_members',
            'communities_members_borno',
            'communities_members_adamawa',
            'communities_members_yobe',
            'idp_members',
            'idp_members_borno',
            'idp_members_adamawa',
            'idp_members_yobe',
            'returnees',
            'returnees_borno',
            'returnees_adamawa',
            'returnees_yobe',
            'goverment_officials',
            'goverment_officials_borno',
            'goverment_officials_adamawa',
            'goverment_officials_yobe',
            'status1_percentage',
            'status2_percentage',
            'status3_percentage',
            'status4_percentage',
            'status1_percentage_borno',
            'status2_percentage_borno',
            'status3_percentage_borno',
            'status4_percentage_borno',
            'status1_percentage_adamawa',
            'status2_percentage_adamawa',
            'status3_percentage_adamawa',
            'status4_percentage_adamawa',
            'status1_percentage_yobe',
            'status2_percentage_yobe',
            'status3_percentage_yobe',
            'status4_percentage_yobe',
            'bornoBeneficiaries',
            'adamawaBeneficiaries',
            'yobeBeneficiaries',
            'borno', 'adamawa', 'yobe',
        ));
    }

    public function GoogleView()
    {
        return view('pages.dashboard');
    }

    public function get_percentage($part, $whole){
         if($part==0 || $whole==0 || $part == "" || $whole== ""){
            return 0;
        }else{
            return $part/$whole*100;
        }
    }
}
