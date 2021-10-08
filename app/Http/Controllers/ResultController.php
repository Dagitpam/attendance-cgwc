<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Allocation;
use App\Investment;
use App\Project;
use App\Beneficiary;
use App\Social;
use App\Feedback;
use App\Communication;
use App\Complain;
use App\Transport;

class ResultController extends Controller
{
    public function allocated()
    {
        $allocated = Allocation::where('status', 'allocated')->get();
        return $allocated;
    }

    public function get_percentage($part, $whole){
        if(!is_numeric($part) || !is_numeric($whole)){
            return 0;
        }elseif($part == 0 || $whole == 0){
            return 0;
        }else{
            return round($part/$whole*100, 1);
        }
    }

    public function index()
    {
        $allocated = Allocation::where('status', 'allocated')->get();
        $released = Allocation::where('status', 'released')->get();
        $investments = Investment::all();
        $projects = Project::all();

        // calculate financial progress
        $spend = Project::all()->sum('amount_spend');
        $disbursed = Project::all()->sum('amount_disbursed');

        $spend_borno = Project::where('state_id', 8)->sum('amount_spend');
        $disbursed_borno = Project::where('state_id', 8)->sum('amount_disbursed');

        $spend_adm = Project::where('state_id', 2)->sum('amount_spend');
        $disbursed_adm = Project::where('state_id', 2)->sum('amount_disbursed');

        $spend_yobe = Project::where('state_id', 36)->sum('amount_spend');
        $disbursed_yobe = Project::where('state_id', 36)->sum('amount_disbursed');

        $financial_progress_bay = $this->get_percentage($spend, $disbursed);
        $financial_progress_borno = $this->get_percentage($spend_borno, $disbursed_borno);
        $financial_progress_adm = $this->get_percentage($spend_adm, $disbursed_adm);
        $financial_progress_yobe = $this->get_percentage($spend_yobe, $disbursed_yobe);

        // Calclulate physical progress
        $total_projects_bay = Project::all()->count();
        $functional_projects_bay = Project::where('status_id', 1)->orWhere('status_id', 2)->count();

        $total_projects_borno = Project::where('state_id', 8)->count();
        $functional_projects_borno = Project::where('state_id', 8)->where('status_id', 1)->orWhere('status_id', 2)->count();

        $total_projects_adm = Project::where('state_id', 2)->count();
        $functional_projects_adm = Project::where('state_id', 2)->where('status_id', 1)->orWhere('status_id', 2)->count();

        $total_projects_yobe = Project::where('state_id', 36)->count();
        $functional_projects_yobe = Project::where('state_id', 36)->where('status_id', 1)->orWhere('status_id', 2)->count();

        $physical_progress_bay = $this->get_percentage($functional_projects_bay, $total_projects_bay);
        $physical_progress_borno = $this->get_percentage($functional_projects_borno, $total_projects_borno);
        $physical_progress_adm = $this->get_percentage($functional_projects_adm, $total_projects_adm);
        $physical_progress_yobe = $this->get_percentage($functional_projects_yobe, $total_projects_yobe);


        // $beneficiaries = Beneficiary::all();

        $adamawaInvestments = Investment::whereHas('state', function ($query) {
            $query->where('name', 'Adamawa');
        })->get();
        $bornoInvestments = Investment::whereHas('state', function ($query) {
            $query->where('name', 'Borno');
        })->get();
        $yobeInvestments = Investment::whereHas('state', function ($query) {
            $query->where('name', 'Yobe');
        })->get();

        // $adamawaBeneficiaries = Beneficiary::whereHas('state', function ($query) {
        //     $query->where('name', 'Adamawa');
        // })->get();

        // $bornoBeneficiaries = Beneficiary::whereHas('state', function ($query) {
        //     $query->where('name', 'Borno');
        // })->get();

        // $yobeBeneficiaries = Beneficiary::whereHas('state', function ($query) {
        //     $query->where('name', 'Yobe');
        // })->get();

        $adamawaSocials = Social::whereHas('state', function ($query) {
            $query->where('name', 'Adamawa');
        })->get();
        $yobeSocials = Social::whereHas('state', function ($query) {
            $query->where('name', 'Yobe');
        })->get();
        $bornoSocials = Social::whereHas('state', function ($query) {
            $query->where('name', 'Borno');
        })->get();

        $adamawaFeedback = Feedback::whereHas('state', function ($query) {
            $query->where('name', 'Adamawa');
        })->get();
        $bornoFeedback = Feedback::whereHas('state', function ($query) {
            $query->where('name', 'Borno');
        })->get();
        $yobeFeedback = Feedback::whereHas('state', function ($query) {
            $query->where('name', 'Yobe');
        })->get();

        $adamawaCommunication = Communication::whereHas('state', function ($query) {
            $query->where('name', 'Adamawa');
        })->get();
        $bornoCommunication = Communication::whereHas('state', function ($query) {
            $query->where('name', 'Borno');
        })->get();
        $yobeCommunication = Communication::whereHas('state', function ($query) {
            $query->where('name', 'Yobe');
        })->get();

        $adamawaComplain = Complain::whereHas('state', function ($query) {
            $query->where('name', 'Adamawa');
        })->get();
        $bornoComplain = Complain::whereHas('state', function ($query) {
            $query->where('name', 'Borno');
        })->get();
        $yobeComplain = Complain::whereHas('state', function ($query) {
            $query->where('name', 'Yobe');
        })->get();

        $adamawaTransport = Transport::whereHas('state', function ($query) {
            $query->where('name', 'Adamawa');
        })->get();
        $bornoTransport = Transport::whereHas('state', function ($query) {
            $query->where('name', 'Borno');
        })->get();
        $yobeTransport = Transport::whereHas('state', function ($query) {
            $query->where('name', 'Yobe');
        })->get();

        $adamawaProjects = Project::whereHas('state', function ($query) {
            $query->where('name', 'Adamawa');
        })->get();

        $bornoProjects = Project::whereHas('state', function ($query) {
            $query->where('name', 'Borno');
        })->get();
        $yobeProjects = Project::whereHas('state', function ($query) {
            $query->where('name', 'Yobe');
        })->get();
        return view(
            'results',
            compact(
                'allocated',
                'released',
                'adamawaInvestments',
                'bornoInvestments',
                'yobeInvestments',
                'investments',
                'projects',
                'financial_progress_bay',
                'financial_progress_borno',
                'financial_progress_adm',
                'financial_progress_yobe',
                'physical_progress_bay',
                'physical_progress_borno',
                'physical_progress_adm',
                'physical_progress_yobe',
                'adamawaSocials',
                'bornoSocials',
                'yobeSocials',
                'adamawaFeedback',
                'bornoFeedback',
                'yobeFeedback',
                'adamawaCommunication',
                'bornoCommunication',
                'yobeCommunication',
                'adamawaComplain',
                'bornoComplain',
                'yobeComplain',
                'adamawaTransport',
                'bornoTransport',
                'yobeTransport',
                'adamawaProjects',
                'bornoProjects',
                'yobeProjects'
            )
        );
    }

    public function landing()
    {
        $allocated = Allocation::where('status', 'allocated')->get();
        $released = Allocation::where('status', 'released')->get();
        $investments = Investment::all();
        $projects = Project::all();
        // $beneficiaries = Beneficiary::all();

        // calculate financial progress
        $spend = Project::all()->sum('amount_spend');
        $disbursed = Project::all()->sum('amount_disbursed');

        $spend_borno = Project::where('state_id', 8)->sum('amount_spend');
        $disbursed_borno = Project::where('state_id', 8)->sum('amount_disbursed');

        $spend_adm = Project::where('state_id', 2)->sum('amount_spend');
        $disbursed_adm = Project::where('state_id', 2)->sum('amount_disbursed');

        $spend_yobe = Project::where('state_id', 36)->sum('amount_spend');
        $disbursed_yobe = Project::where('state_id', 36)->sum('amount_disbursed');

        $financial_progress_bay = $this->get_percentage($spend, $disbursed);
        $financial_progress_borno = $this->get_percentage($spend_borno, $disbursed_borno);
        $financial_progress_adm = $this->get_percentage($spend_adm, $disbursed_adm);
        $financial_progress_yobe = $this->get_percentage($spend_yobe, $disbursed_yobe);

        // Calclulate physical progress
        $total_projects_bay = Project::all()->count();
        $functional_projects_bay = Project::where('status_id', 1)->orWhere('status_id', 2)->count();

        $total_projects_borno = Project::where('state_id', 8)->count();
        $functional_projects_borno = Project::where('state_id', 8)->where('status_id', 1)->orWhere('status_id', 2)->count();

        $total_projects_adm = Project::where('state_id', 2)->count();
        $functional_projects_adm = Project::where('state_id', 2)->where('status_id', 1)->orWhere('status_id', 2)->count();

        $total_projects_yobe = Project::where('state_id', 36)->count();
        $functional_projects_yobe = Project::where('state_id', 36)->where('status_id', 1)->orWhere('status_id', 2)->count();

        $physical_progress_bay = $this->get_percentage($functional_projects_bay, $total_projects_bay);
        $physical_progress_borno = $this->get_percentage($functional_projects_borno, $total_projects_borno);
        $physical_progress_adm = $this->get_percentage($functional_projects_adm, $total_projects_adm);
        $physical_progress_yobe = $this->get_percentage($functional_projects_yobe, $total_projects_yobe);


        $adamawaInvestments = Investment::whereHas('state', function ($query) {
            $query->where('name', 'Adamawa');
        })->get();
        $bornoInvestments = Investment::whereHas('state', function ($query) {
            $query->where('name', 'Borno');
        })->get();
        $yobeInvestments = Investment::whereHas('state', function ($query) {
            $query->where('name', 'Yobe');
        })->get();

        // $adamawaBeneficiaries = Beneficiary::whereHas('state', function ($query) {
        //     $query->where('name', 'Adamawa');
        // })->get();

        // $bornoBeneficiaries = Beneficiary::whereHas('state', function ($query) {
        //     $query->where('name', 'Borno');
        // })->get();

        // $yobeBeneficiaries = Beneficiary::whereHas('state', function ($query) {
        //     $query->where('name', 'Yobe');
        // })->get();

        $adamawaSocials = Social::whereHas('state', function ($query) {
            $query->where('name', 'Adamawa');
        })->get();
        $yobeSocials = Social::whereHas('state', function ($query) {
            $query->where('name', 'Yobe');
        })->get();
        $bornoSocials = Social::whereHas('state', function ($query) {
            $query->where('name', 'Borno');
        })->get();

        $adamawaFeedback = Feedback::whereHas('state', function ($query) {
            $query->where('name', 'Adamawa');
        })->get();
        $bornoFeedback = Feedback::whereHas('state', function ($query) {
            $query->where('name', 'Borno');
        })->get();
        $yobeFeedback = Feedback::whereHas('state', function ($query) {
            $query->where('name', 'Yobe');
        })->get();

        $adamawaCommunication = Communication::whereHas('state', function ($query) {
            $query->where('name', 'Adamawa');
        })->get();
        $bornoCommunication = Communication::whereHas('state', function ($query) {
            $query->where('name', 'Borno');
        })->get();
        $yobeCommunication = Communication::whereHas('state', function ($query) {
            $query->where('name', 'Yobe');
        })->get();

        $adamawaComplain = Complain::whereHas('state', function ($query) {
            $query->where('name', 'Adamawa');
        })->get();
        $bornoComplain = Complain::whereHas('state', function ($query) {
            $query->where('name', 'Borno');
        })->get();
        $yobeComplain = Complain::whereHas('state', function ($query) {
            $query->where('name', 'Yobe');
        })->get();

        $adamawaTransport = Transport::whereHas('state', function ($query) {
            $query->where('name', 'Adamawa');
        })->get();
        $bornoTransport = Transport::whereHas('state', function ($query) {
            $query->where('name', 'Borno');
        })->get();
        $yobeTransport = Transport::whereHas('state', function ($query) {
            $query->where('name', 'Yobe');
        })->get();

        $adamawaProjects = Project::whereHas('state', function ($query) {
            $query->where('name', 'Adamawa');
        })->get();

        $bornoProjects = Project::whereHas('state', function ($query) {
            $query->where('name', 'Borno');
        })->get();
        $yobeProjects = Project::whereHas('state', function ($query) {
            $query->where('name', 'Yobe');
        })->get();
        return view(
            'results.public',
            compact(
                'allocated',
                'released',
                'adamawaInvestments',
                'bornoInvestments',
                'yobeInvestments',
                'investments',
                'projects',
                'financial_progress_bay',
                'financial_progress_borno',
                'financial_progress_adm',
                'financial_progress_yobe',
                'physical_progress_bay',
                'physical_progress_borno',
                'physical_progress_adm',
                'physical_progress_yobe',
                'adamawaSocials',
                'bornoSocials',
                'yobeSocials',
                'adamawaFeedback',
                'bornoFeedback',
                'yobeFeedback',
                'adamawaCommunication',
                'bornoCommunication',
                'yobeCommunication',
                'adamawaComplain',
                'bornoComplain',
                'yobeComplain',
                'adamawaTransport',
                'bornoTransport',
                'yobeTransport',
                'adamawaProjects',
                'bornoProjects',
                'yobeProjects'
            )
        );
    }
}
