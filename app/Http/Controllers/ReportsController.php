<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\State;
use App\Community;
use App\Reports;
use App\Welfare;
use App\Beneficiary;
use App\C2beneficiary;
use App\C1Bulk;
use App\Project;
use App\Project_category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;


class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function beneficiaries($component = "")
    {
        if ($component == ""){
            $male_bay = $this->get_by_genders(0, 2, 0);
            $female_bay = $this->get_by_genders(0, 1, 0);

            //Borno
            $male_borno = $this->get_by_genders(8, 2, 0);
            $female_borno = $this->get_by_genders(8, 1, 0);

            // Adamawa
            $male_adm = $this->get_by_genders(2, 2, 0);
            $female_adm = $this->get_by_genders(2, 1, 0);

            // Yobe
            $male_yobe = $this->get_by_genders(36, 2, 0);
            $female_yobe = $this->get_by_genders(36, 1, 0);


            // Non individual entries
            $other_ben = C2beneficiary::all()->sum('beneficiaries');
            $slice = $other_ben/2;

            // BAY
            $ben_bay = Beneficiary::all()->count();
            $ben_bay += $other_ben;

            // Beneficiary status: Borno numbers
            $cm_borno = $this->get_status(8, 1);
            $idp_borno = $this->get_status(8, 2);
            $rtn_borno = $this->get_status(8, 3);
            $go_borno = $this->get_status(8, 4);

            // Beneficiary status: Adamawa numbers
            $cm_adm = $this->get_status(2, 1);
            $idp_adm = $this->get_status(2, 2);
            $rtn_adm = $this->get_status(2, 3);
            $go_adm = $this->get_status(2, 4);

            // Beneficiary status: Yobe numbers
            $cm_yobe = $this->get_status(36, 1);
            $idp_yobe = $this->get_status(36, 2);
            $rtn_yobe = $this->get_status(36, 3);
            $go_yobe = $this->get_status(36, 4);


            // Beneficiary status: BAY states
            $cm_bay = $this->get_status(0, 1);
            $idp_bay = $this->get_status(0, 2);
            $rtn_bay = $this->get_status(0, 3);
            $go_bay = $this->get_status(0, 4);

            $benefits = Welfare::all();

            //  $by_year_month = Beneficiary::select('select year(date) as year, month(date) as month, sum(paid) as total_amount from amount_table group by year(date), month(date)');
            $last3years = DB::select('select year(created_at) as year, COUNT(*) as total_beneficiaries from beneficiaries group by year(created_at)');
            $last12months = DB::select('select month(created_at) as month, COUNT(*) as total_beneficiaries from beneficiaries group by month(created_at)');
            $last30days = DB::select('select day(created_at) as day, month(created_at) as month, COUNT(*) as total_beneficiaries from beneficiaries WHERE DATE(created_at) >= DATE(NOW()) - INTERVAL 30 DAY group by day(created_at), month(created_at)');

            //  print_r($last3years); exit();

            $component = "";

            return view('reports.index',
                compact(
                    'ben_bay',
                    'male_bay',
                    'female_bay',
                    'male_borno',
                    'female_borno',
                    'male_adm',
                    'female_adm',
                    'male_yobe',
                    'female_yobe',
                    'cm_borno',
                    'idp_borno',
                    'rtn_borno',
                    'go_borno',
                    'cm_adm',
                    'idp_adm',
                    'rtn_adm',
                    'go_adm',
                    'cm_yobe',
                    'idp_yobe',
                    'rtn_yobe',
                    'go_yobe',
                    'cm_bay',
                    'idp_bay',
                    'rtn_bay',
                    'go_bay',
                    'benefits',
                    'last3years',
                    'last12months',
                    'last30days',
                    'component',
                )
            );

        }else{

            switch($component){

                case "1":
                    $male_bay = $this->get_by_genders(0, 2, 1);
                    $female_bay = $this->get_by_genders(0, 1, 1);

                    //Borno
                    $male_borno = $this->get_by_genders(8, 2, 1);
                    $female_borno = $this->get_by_genders(8, 1, 1);

                    // Adamawa
                    $male_adm = $this->get_by_genders(2, 2, 1);
                    $female_adm = $this->get_by_genders(2, 1, 1);

                    // Yobe
                    $male_yobe = $this->get_by_genders(36, 2, 1);
                    $female_yobe = $this->get_by_genders(36, 1, 1);

                    // BAY
                    $ben_bay = Beneficiary::all()->count();
                    $ben_bay += C1Bulk::all()->sum('female_participants');
                    $ben_bay += C1Bulk::all()->sum('male_participants');

                    // Beneficiary status: Borno numbers
                    $cm_borno = $this->get_status(8, 1, 1);
                    $idp_borno = $this->get_status(8, 2, 1);
                    $rtn_borno = $this->get_status(8, 3, 1);
                    $go_borno = $this->get_status(8, 4, 1);

                    // Beneficiary status: Adamawa numbers
                    $cm_adm = $this->get_status(2, 1, 1);
                    $idp_adm = $this->get_status(2, 2, 1);
                    $rtn_adm = $this->get_status(2, 3, 1);
                    $go_adm = $this->get_status(2, 4, 1);

                    // Beneficiary status: Yobe numbers
                    $cm_yobe = $this->get_status(36, 1, 1);
                    $idp_yobe = $this->get_status(36, 2, 1);
                    $rtn_yobe = $this->get_status(36, 3, 1);
                    $go_yobe = $this->get_status(36, 4, 1);


                    // Beneficiary status: BAY states
                    $cm_bay = $this->get_status(0, 1, 1);
                    $idp_bay = $this->get_status(0, 2, 1);
                    $rtn_bay = $this->get_status(0, 3, 1);
                    $go_bay = $this->get_status(0, 4, 1);

                    $benefits = Welfare::where('component_id', 1)->get();

                    // //  $by_year_month = Beneficiary::select('select year(date) as year, month(date) as month, sum(paid) as total_amount from amount_table group by year(date), month(date)');
                    // $last3years = DB::select('select year(created_at) as year, COUNT(*) as total_beneficiaries from beneficiaries group by year(created_at)');
                    // $last12months = DB::select('select month(created_at) as month, COUNT(*) as total_beneficiaries from beneficiaries group by month(created_at)');
                    // $last30days = DB::select('select day(created_at) as day, month(created_at) as month, COUNT(*) as total_beneficiaries from beneficiaries WHERE DATE(created_at) >= DATE(NOW()) - INTERVAL 30 DAY group by day(created_at), month(created_at)');

                    //  print_r($last3years); exit();

                    $component = 1;

                    return view('reports.index',
                        compact(
                            'ben_bay',
                            'male_bay',
                            'female_bay',
                            'male_borno',
                            'female_borno',
                            'male_adm',
                            'female_adm',
                            'male_yobe',
                            'female_yobe',
                            'cm_borno',
                            'idp_borno',
                            'rtn_borno',
                            'go_borno',
                            'cm_adm',
                            'idp_adm',
                            'rtn_adm',
                            'go_adm',
                            'cm_yobe',
                            'idp_yobe',
                            'rtn_yobe',
                            'go_yobe',
                            'cm_bay',
                            'idp_bay',
                            'rtn_bay',
                            'go_bay',
                            'benefits',
                            // 'last3years',
                            // 'last12months',
                            // 'last30days',
                            'component',
                        )
                    );

                break;

                case "2":
                    $male_bay = $this->get_by_genders(0, 2, 2);
                    $female_bay = $this->get_by_genders(0, 1, 2);

                    //Borno
                    $male_borno = $this->get_by_genders(8, 2, 2);
                    $female_borno = $this->get_by_genders(8, 1, 2);

                    // Adamawa
                    $male_adm = $this->get_by_genders(2, 2, 2);
                    $female_adm = $this->get_by_genders(2, 1, 2);

                    // Yobe
                    $male_yobe = $this->get_by_genders(36, 2, 2);
                    $female_yobe = $this->get_by_genders(36, 1, 2);

                    // BAY
                    $ben_bay = C2beneficiary::all()->sum('beneficiaries');

                    // Beneficiary status: Borno numbers
                    $cm_borno = $this->get_status(8, 1, 2);
                    $idp_borno = $this->get_status(8, 2, 2);
                    $rtn_borno = $this->get_status(8, 3, 2);
                    $go_borno = $this->get_status(8, 4, 2);

                    // Beneficiary status: Adamawa numbers
                    $cm_adm = $this->get_status(2, 1, 2);
                    $idp_adm = $this->get_status(2, 2, 2);
                    $rtn_adm = $this->get_status(2, 3, 2);
                    $go_adm = $this->get_status(2, 4, 2);

                    // Beneficiary status: Yobe numbers
                    $cm_yobe = $this->get_status(36, 1, 2);
                    $idp_yobe = $this->get_status(36, 2, 2);
                    $rtn_yobe = $this->get_status(36, 3, 2);
                    $go_yobe = $this->get_status(36, 4, 2);


                    // Beneficiary status: BAY states
                    $cm_bay = $this->get_status(0, 1, 2);
                    $idp_bay = $this->get_status(0, 2, 2);
                    $rtn_bay = $this->get_status(0, 3, 2);
                    $go_bay = $this->get_status(0, 4, 2);

                    $benefits = Welfare::where('component_id', 2)->get();

                    //  $by_year_month = Beneficiary::select('select year(date) as year, month(date) as month, sum(paid) as total_amount from amount_table group by year(date), month(date)');
                    // $last3years = DB::select('select year(created_at) as year, COUNT(*) as total_beneficiaries from beneficiaries group by year(created_at)');
                    // $last12months = DB::select('select month(created_at) as month, COUNT(*) as total_beneficiaries from beneficiaries group by month(created_at)');
                    // $last30days = DB::select('select day(created_at) as day, month(created_at) as month, COUNT(*) as total_beneficiaries from beneficiaries WHERE DATE(created_at) >= DATE(NOW()) - INTERVAL 30 DAY group by day(created_at), month(created_at)');

                    //  print_r($last3years); exit();

                    $component = 2;

                    return view('reports.index',
                        compact(
                            'ben_bay',
                            'male_bay',
                            'female_bay',
                            'male_borno',
                            'female_borno',
                            'male_adm',
                            'female_adm',
                            'male_yobe',
                            'female_yobe',
                            'cm_borno',
                            'idp_borno',
                            'rtn_borno',
                            'go_borno',
                            'cm_adm',
                            'idp_adm',
                            'rtn_adm',
                            'go_adm',
                            'cm_yobe',
                            'idp_yobe',
                            'rtn_yobe',
                            'go_yobe',
                            'cm_bay',
                            'idp_bay',
                            'rtn_bay',
                            'go_bay',
                            'benefits',
                            // 'last3years',
                            // 'last12months',
                            // 'last30days',
                            'component',
                        )
                    );

                break;
            }
        }
    }

    public function projects($component = "")
    {
        if ($component == ""){
            // projects by state
            $borno_projects = Project::where('state_id', 8)->count();
            $adm_projects = Project::where('state_id', 2)->count();
            $yobe_projects = Project::where('state_id', 36)->count();

            // status by state
            $borno_functional = Project::where('state_id', 8)->where('status_id', 1)->count();
            $borno_non_functional = Project::where('state_id', 8)->where('status_id', 2)->orWhere('status_id', 3)->count();
            $adm_functional = Project::where('state_id', 2)->where('status_id', 1)->count();
            $adm_non_functional = Project::where('state_id', 2)->where('status_id', 2)->orWhere('status_id', 3)->count();
            $yobe_functional = Project::where('state_id', 36)->where('status_id', 1)->count();
            $yobe_non_functional = Project::where('state_id', 36)->where('status_id', 2)->orWhere('status_id', 3)->count();


            // amount disbursed
            $borno_amount_disbursed = Project::where('state_id', 8)->sum('amount_disbursed');
            $adm_amount_disbursed = Project::where('state_id', 2)->sum('amount_disbursed');
            $yobe_amount_disbursed = Project::where('state_id', 36)->sum('amount_disbursed');

            // amount spend
            $borno_amount_spend = Project::where('amount_spend', 8)->sum('amount_spend');
            $adm_amount_spend = Project::where('amount_spend', 2)->sum('amount_spend');
            $yobe_amount_spend = Project::where('amount_spend', 36)->sum('amount_spend');

            $categories = Project_category::all();

            return view('reports.projects',
                compact(
                    'borno_projects',
                    'adm_projects',
                    'yobe_projects',
                    'borno_functional',
                    'borno_non_functional',
                    'adm_functional',
                    'adm_non_functional',
                    'yobe_functional',
                    'yobe_non_functional',
                    'borno_amount_disbursed',
                    'adm_amount_disbursed',
                    'yobe_amount_disbursed',
                    'borno_amount_spend',
                    'adm_amount_spend',
                    'yobe_amount_spend',
                    'categories',
            ));

        }else{

            switch($component){
                case "1":
                    // projects by state
                    $borno_projects = Project::where('state_id', 8)->where('component_id', 1)->count();
                    $adm_projects = Project::where('state_id', 2)->where('component_id', 1)->count();
                    $yobe_projects = Project::where('state_id', 36)->where('component_id', 1)->count();

                    // status by state
                    $borno_functional = Project::where('state_id', 8)->where('component_id', 1)->where('status_id', 1)->count();
                    $borno_non_functional = Project::where('state_id', 8)->where('component_id', 1)->where('status_id', 2)->orWhere('status_id', 3)->count();
                    $adm_functional = Project::where('state_id', 2)->where('component_id', 1)->where('status_id', 1)->count();
                    $adm_non_functional = Project::where('state_id', 2)->where('component_id', 1)->where('status_id', 2)->orWhere('status_id', 3)->count();
                    $yobe_functional = Project::where('state_id', 36)->where('component_id', 1)->where('status_id', 1)->count();
                    $yobe_non_functional = Project::where('state_id', 36)->where('component_id', 1)->where('status_id', 2)->orWhere('status_id', 3)->count();


                    // amount disbursed
                    $borno_amount_disbursed = Project::where('state_id', 8)->where('component_id', 1)->sum('amount_disbursed');
                    $adm_amount_disbursed = Project::where('state_id', 2)->where('component_id', 1)->sum('amount_disbursed');
                    $yobe_amount_disbursed = Project::where('state_id', 36)->where('component_id', 1)->sum('amount_disbursed');

                    // amount spend
                    $borno_amount_spend = Project::where('amount_spend', 8)->where('component_id', 1)->sum('amount_spend');
                    $adm_amount_spend = Project::where('amount_spend', 2)->where('component_id', 1)->sum('amount_spend');
                    $yobe_amount_spend = Project::where('amount_spend', 36)->where('component_id', 1)->sum('amount_spend');

                    $categories = Project_category::all();

                    return view('reports.projects',
                        compact(
                            'borno_projects',
                            'adm_projects',
                            'yobe_projects',
                            'borno_functional',
                            'borno_non_functional',
                            'adm_functional',
                            'adm_non_functional',
                            'yobe_functional',
                            'yobe_non_functional',
                            'borno_amount_disbursed',
                            'adm_amount_disbursed',
                            'yobe_amount_disbursed',
                            'borno_amount_spend',
                            'adm_amount_spend',
                            'yobe_amount_spend',
                            'categories',
                    ));
                break;


                case "2":
                    // projects by state
                    $borno_projects = Project::where('state_id', 8)->where('component_id', 2)->count();
                    $adm_projects = Project::where('state_id', 2)->where('component_id', 2)->count();
                    $yobe_projects = Project::where('state_id', 36)->where('component_id', 2)->count();

                    // status by state
                    $borno_functional = Project::where('state_id', 8)->where('component_id', 2)->where('status_id', 1)->count();
                    $borno_non_functional = Project::where('state_id', 8)->where('component_id', 2)->where('status_id', 2)->orWhere('status_id', 3)->count();
                    $adm_functional = Project::where('state_id', 2)->where('component_id', 2)->where('status_id', 1)->count();
                    $adm_non_functional = Project::where('state_id', 2)->where('component_id', 2)->where('status_id', 2)->orWhere('status_id', 3)->count();
                    $yobe_functional = Project::where('state_id', 36)->where('component_id', 2)->where('status_id', 1)->count();
                    $yobe_non_functional = Project::where('state_id', 36)->where('component_id', 2)->where('status_id', 2)->orWhere('status_id', 3)->count();


                    // amount disbursed
                    $borno_amount_disbursed = Project::where('state_id', 8)->where('component_id', 2)->sum('amount_disbursed');
                    $adm_amount_disbursed = Project::where('state_id', 2)->where('component_id', 2)->sum('amount_disbursed');
                    $yobe_amount_disbursed = Project::where('state_id', 36)->where('component_id', 2)->sum('amount_disbursed');

                    // amount spend
                    $borno_amount_spend = Project::where('amount_spend', 8)->where('component_id', 2)->sum('amount_spend');
                    $adm_amount_spend = Project::where('amount_spend', 2)->where('component_id', 2)->sum('amount_spend');
                    $yobe_amount_spend = Project::where('amount_spend', 36)->where('component_id', 2)->sum('amount_spend');

                    $categories = Project_category::all();

                    return view('reports.projects',
                        compact(
                            'borno_projects',
                            'adm_projects',
                            'yobe_projects',
                            'borno_functional',
                            'borno_non_functional',
                            'adm_functional',
                            'adm_non_functional',
                            'yobe_functional',
                            'yobe_non_functional',
                            'borno_amount_disbursed',
                            'adm_amount_disbursed',
                            'yobe_amount_disbursed',
                            'borno_amount_spend',
                            'adm_amount_spend',
                            'yobe_amount_spend',
                            'categories',
                    ));
                break;


                case "3":
                    // projects by state
                    $borno_projects = Project::where('state_id', 8)->where('component_id', 3)->count();
                    $adm_projects = Project::where('state_id', 2)->where('component_id', 3)->count();
                    $yobe_projects = Project::where('state_id', 36)->where('component_id', 3)->count();

                    // status by state
                    $borno_functional = Project::where('state_id', 8)->where('component_id', 3)->where('status_id', 1)->count();
                    $borno_non_functional = Project::where('state_id', 8)->where('component_id', 3)->where('status_id', 2)->orWhere('status_id', 3)->count();
                    $adm_functional = Project::where('state_id', 2)->where('component_id', 3)->where('status_id', 1)->count();
                    $adm_non_functional = Project::where('state_id', 2)->where('component_id', 3)->where('status_id', 2)->orWhere('status_id', 3)->count();
                    $yobe_functional = Project::where('state_id', 36)->where('component_id', 3)->where('status_id', 1)->count();
                    $yobe_non_functional = Project::where('state_id', 36)->where('component_id', 3)->where('status_id', 2)->orWhere('status_id', 3)->count();


                    // amount disbursed
                    $borno_amount_disbursed = Project::where('state_id', 8)->where('component_id', 3)->sum('amount_disbursed');
                    $adm_amount_disbursed = Project::where('state_id', 2)->where('component_id', 3)->sum('amount_disbursed');
                    $yobe_amount_disbursed = Project::where('state_id', 36)->where('component_id', 3)->sum('amount_disbursed');

                    // amount spend
                    $borno_amount_spend = Project::where('amount_spend', 8)->where('component_id', 3)->sum('amount_spend');
                    $adm_amount_spend = Project::where('amount_spend', 2)->where('component_id', 3)->sum('amount_spend');
                    $yobe_amount_spend = Project::where('amount_spend', 36)->where('component_id', 3)->sum('amount_spend');

                    $categories = Project_category::all();

                    return view('reports.projects',
                        compact(
                            'borno_projects',
                            'adm_projects',
                            'yobe_projects',
                            'borno_functional',
                            'borno_non_functional',
                            'adm_functional',
                            'adm_non_functional',
                            'yobe_functional',
                            'yobe_non_functional',
                            'borno_amount_disbursed',
                            'adm_amount_disbursed',
                            'yobe_amount_disbursed',
                            'borno_amount_spend',
                            'adm_amount_spend',
                            'yobe_amount_spend',
                            'categories',
                    ));
                break;
            }
        }

    }

    public function get_status($state_id, $status_id, $component_id = 0){

        if($component_id == 0){

            $other_ben = C2beneficiary::all()->sum('beneficiaries');
            $slice = $other_ben/2;

            if($state_id == 0){
                $ben = Beneficiary::where('status_id', $status_id)->count();
                return $ben += $slice;
            }else{
                $ben = Beneficiary::where('state_id', $state_id)->where('status_id', $status_id)->count();
                return $ben += $slice;
            }

        }else{
            switch($component_id){

                case "1":
                    // $other_ben = C2Beneficiary::all()->sum('beneficiaries');
                    // $slice = $other_ben/2;

                    if($state_id == 0){
                        $ben1 = Beneficiary::where('status_id', $status_id)->count();
                        $ben2 = C1Bulk::all()->sum('male_participants');
                        $ben2 += C1Bulk::all()->sum('female_participants');
                        return $ben1 + $ben2;
                    }else{
                        $ben1 = Beneficiary::where('state_id', $state_id)->where('status_id', $status_id)->count();
                        $ben2 = C1Bulk::where('state_id', $state_id)->sum('male_participants');
                        $ben2 += C1Bulk::where('state_id', $state_id)->sum('female_participants');
                        return $ben1 + $ben2;
                    }
                break;


                case "2":
                    $ben = C2beneficiary::all()->sum('beneficiaries');
                break;

            }
        }

    }

    public function get_by_genders($state_id, $gender_id, $component_id = 0){

        if($component_id == 0){
            $other_ben = C2beneficiary::all()->sum('beneficiaries');
            $slice = $other_ben/2;

            if($state_id == 0){
                $ben = Beneficiary::where('gender', $gender_id)->count();
                return $ben += $slice;
            }else{
                $ben = Beneficiary::where('state_id', $state_id)->where('gender', $gender_id)->count();
                return $ben += $slice;
            }
        }else{
            switch($component_id){
                case "1":
                    if($state_id == 0){
                        $ben1 = Beneficiary::where('gender', $gender_id)->count();
                        $ben2 = C1Bulk::all()->sum('male_participants');
                        $ben2 += C1Bulk::all()->sum('female_participants');
                        return $ben1 + $ben2;
                    }else{
                        $ben1 = Beneficiary::where('state_id', $state_id)->where('gender', $gender_id)->count();
                        $ben2 = C1Bulk::all()->sum('male_participants');
                        $ben2 += C1Bulk::all()->sum('female_participants');
                        return $ben1 + $ben2;
                    }
                break;
            }
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $state = State::all();
        $communities = Community::all();
        $benefit = Welfare::all();
        return view('trackers.reports-create',compact('state','communities','benefit'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateReport();
        try{
            $newImageName = time().'-'. $request->name . '.' .$request->image->extension();
            $request->image->move(public_path('images'), $newImageName);
            $report = new Reports(request([
                'state_id',
                'community',
                'activity',
                'indicator',
                'component',
                'target',
                'description',
                'results',
                'challenge',
                'reported_by',
            ]));
            $report->slug = Str::uuid();
            $report->image = $newImageName;
            return back()->with('success','Report Added successfully');
        }catch(\Exception $e){
            $bug = $e->getMessage();
            return redirect()->back()->with('error',$bug);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $report = Reports::where('slug', $id)->first();
        return view('trackers.reports-show',compact('report'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $report = Reports::where('slug', $id)->first();
        $communities = Community::all();
        $benefit = Welfare::all();
        return view('trackers.reports-edit',compact('report','communities','benefit'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validateReport();
        try{
            $newImageName = time().'-'. $request->name . '.' .$request->image->extension();
            $request->image->move(public_path('images'), $newImageName);
            $report = Reports::find($request->id);
            $report->update([
                'state_id'=>$request->state_id,
                'community'=>$request->community,
                'activity'=>$request->activity,
                'indicator'=>$request->indicator,
                'component'=>$request->component,
                'target'=>$request->target,
                'description'=>$request->description,
                'results'=>$request->results,
                'challenge'=>$request->challenge,
                'reported_by'=>$request->reported_by,
                'image'=>$newImageName
            ]);
            return redirect(route('reports.index'))->with('success','Reports updated successfully');
        }catch(\Exception $e){
            $bug = $e->getMessage();
            return redirect()->back()->with('error',$bug);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $report = Reports::where('slug',$id)->first();
        if($report){
            $report->delete();
            return redirect('/report/list')->with('success','Report removed');
        }else{
            return redirect('/report/list')->with('error','Report not found');
        }
    }

    /**
     * Get Deleted indicator Report
     */
    public function getDeletedReport()
    {
        $reports = Reports::onlyTrashed()->get();
        return view('trackers.report-deleted', compact('reports'));
    }

    /**
     * Restore Deleted indicator Report
     */
    public function restoreDeletedReport($id)
    {
        try {
            $reports = Reports::where('slug', $id)->withTrashed()->first();
            $reports->restore();
            return redirect(route('reports.index'))
                        ->with('success', 'Indicator report restored successfully');
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    /**
     * Permanently delete indicator
     */
    public function permanentlyDeleteReport($id)
    {
        try {
            $reports = Reports::where('slug', $id)->withTrashed()->first();
            $reports->forceDelete();
            return redirect(route('reports.index'))
                    ->with('success', 'Permanently deleted indicator report successfully');
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }


    protected function validateReport()
    {
        return request()->validate([
            'state_id'=>'required',
            'community'=>'required|string',
            'activity'=>'required|string',
            'indicator'=>'required|string',
            'component'=>'required|string',
            'target'=>'required|string',
            'description'=>'required|string',
            'results'=>'required|string',
            'challenge'=>'required|string',
            'reported_by'=>'required|string',
            'image'=>'required|image'
        ]);

    }
}
