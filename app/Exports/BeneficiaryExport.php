<?php

namespace App\Exports;

use App\Beneficiary;
use Maatwebsite\Excel\Concerns\FromQuery;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class BeneficiaryExport implements FromView
{
    private $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function view(): View
    {
        return view('beneficiaries/beneficiary-export', [
            'beneficiary' => Beneficiary::where([['state_id', $this->request->state_id],
             ['lga_id', $this->request->lga_id],
              ['gender', $this->request->gender],
              ['benefit_id', $this->request->benefit_id],
              ['status_id', $this->request->status_id]
              ])->whereBetween('age', [$this->request->age_from, $this->request->age_to])->get()  
        ]);
    }
}
