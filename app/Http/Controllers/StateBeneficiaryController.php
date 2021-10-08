<?php

namespace App\Http\Controllers;
ini_set('memory_limit', '200M');
use Illuminate\Http\Request;
use App\Beneficiary;
use App\Lga;
use App\Community;
use App\Welfare;
use App\State;
use App\Project;
use App\Status;

use Illuminate\Support\Facades\DB;

class StateBeneficiaryController extends Controller
{
    /**
     * Retreive beneficiaries count by parameters
     * @return \Illuminate\Http\Response
     */
    public function getBeneficiaryByState($stateId)
    {
        // $id = $stateId;
        $male = Beneficiary::where('state_id', $stateId)->where('gender', 2)->count();
        $female = Beneficiary::where('state_id', $stateId)->where('gender', 1)->count();
        $beneficiary = Beneficiary::where('state_id', $stateId)->paginate(500);
        $state = State::find($stateId);
        $states = State::all();
        $benefits = Welfare::all();
        $statuses = Status::all();
        $lgas = Lga::whereIn('state_id', [2,8,36])->get();
        $num_projects = Project::where('state_id', $stateId)->count();

        return view('states.dashboard', ['male'=>$male,
                                        'female'=>$female,
                                        'id'=>$stateId,
                                        'state'=> $state,
                                        'states'=> $states,
                                        'num_projects'=>$num_projects,
                                        'benefits'=>$benefits,
                                        'beneficiary'=>$beneficiary,
                                        'statuses'=>$statuses,
                                        'lgas'=>$lgas,
                                        ]);
    }

    /**
     * Get female beneficiary list
     */
    public function getFemaleBeneficiariesByState($stateId)
    {
        $beneficiary = Beneficiary::select("*")->where('state_id', $stateId)->where('gender', 1)->paginate(300);;
        $state = State::find($stateId);
        $gender = "FEMALE";
        return view('states.gender', compact('beneficiary', 'state', 'gender'));
    }

    /**
     * Get male beneficiary list
     */
    public function getMaleBeneficiariesByState($stateId)
    {
        $beneficiary = Beneficiary::select("*")->where('state_id', $stateId)->where('gender', 2)->paginate(300);;
        $state = State::find($stateId);
        $gender = "MALE";
        return view('states.gender', compact('beneficiary', 'state', 'gender'));
    }

    public function filterBeneficiaries(Request $request)
    {
        if ($request->search_criteria == 'lga') {
            $lgas = Beneficiary::where('state_id', $request->state_id)->pluck('lga_id');
            $parameters = Lga::whereIn('id', $lgas)->get();
            return response()->json($parameters);
        } elseif ($request->search_criteria == 'community') {
            $communities = Beneficiary::where('state_id', $request->state_id)->pluck('community_id');
            $parameters = Community::whereIn('id', $communities)->get();
            return response()->json($parameters);
        } elseif ($request->search_criteria == 'benefit') {
            $benefits = Beneficiary::where('state_id', $request->state_id)->pluck('benefit_id');
            $parameters = Welfare::whereIn('id', $benefits)->get();
            return response()->json($parameters);
        }
    }

    public function getBeneficiariesByFilter(Request $request)
    {
        $beneficiary = Beneficiary::where($request->filter.'_id', $request->parameter)->where('state_id', $request->state_id)->paginate(500);
        $male = Beneficiary::where($request->filter.'_id', $request->parameter)->where('state_id', $request->state_id)->where('gender', 2)->count();
        $female = Beneficiary::where($request->filter.'_id', $request->parameter)->where('state_id', $request->state_id)->where('gender', 1)->count();
        $num_projects = Project::where('state_id', $request->state_id)->count();
        $states = State::all();
        $benefits = Welfare::all();
        $statuses  = Status::all();

        // exit("<h1>$male</h1>");
        $id = $request->state_id;

        $state = State::find($id);

        return view('states.dashboard',
            compact(
                'beneficiary',
                'benefits',
                'statuses',
                'male',
                'female',
                'id',
                'state',
                'states',
                'num_projects',
            ));
    }
}
