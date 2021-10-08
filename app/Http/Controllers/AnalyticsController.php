<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Beneficiary;
use App\Community;
use App\State;
use App\Education;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $beneficiaryData = Beneficiary::select(DB::raw("COUNT(*) as count"))
        ->whereYear('created_at', date('Y'))
        ->groupBy(DB::raw("Month(created_at)"))
        ->pluck('count');

        return view('analytics/charts', compact('beneficiaryData'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function beneficiary()
    {
        $beneficiaryData = Beneficiary::select(DB::raw("COUNT(*) as count"))
        ->whereYear('created_at', date('Y'))
        ->groupBy(DB::raw("Month(created_at)"))
        ->pluck('count');
        $beneficiaries = Beneficiary::all();
        $states = State::with('beneficiaries')->get();
        return view('analytics/beneficiary', compact('beneficiaryData', 'beneficiaries', 'states'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function community()
    {
        $bornoBeneficiaries = State::where('name', 'Borno')->get();
        $adamawaBeneficiaries = State::where('name', 'Adamawa')->get();
        $yobeBeneficiaries = State::where('name', 'Yobe')->get();
        return view('analytics/community', compact('bornoBeneficiaries', 'adamawaBeneficiaries', 'yobeBeneficiaries'));
    }


    public function education()
    {
        $bornoBeneficiaries = State::where('name', 'Borno')->get();
        $adamawaBeneficiaries = State::where('name', 'Adamawa')->get();
        $yobeBeneficiaries = State::where('name', 'Yobe')->get();
        return view('analytics/education', compact('bornoBeneficiaries', 'adamawaBeneficiaries', 'yobeBeneficiaries'));
    }

    public function benefit()
    {
        $bornoBeneficiaries = State::where('name', 'Borno')->get();
        $adamawaBeneficiaries = State::where('name', 'Adamawa')->get();
        $yobeBeneficiaries = State::where('name', 'Yobe')->get();
        return view('analytics/benefit', compact('bornoBeneficiaries', 'adamawaBeneficiaries', 'yobeBeneficiaries'));
    }
    public function status()
    {
        $bornoBeneficiaries = State::where('name', 'Borno')->get();
        $adamawaBeneficiaries = State::where('name', 'Adamawa')->get();
        $yobeBeneficiaries = State::where('name', 'Yobe')->get();
        return view('analytics/status', compact('bornoBeneficiaries', 'adamawaBeneficiaries', 'yobeBeneficiaries'));
    }
}
