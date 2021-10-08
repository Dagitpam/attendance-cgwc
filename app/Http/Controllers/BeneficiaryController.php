<?php

namespace App\Http\Controllers;

// namespace App\Http\Controllers\DB;

use Illuminate\Http\Request;
use App\Beneficiary;
use App\Welfare;
use App\Education;
use App\Status;
use App\State;
use App\Lga;
use App\Sector;
use App\Community;
use App\Component;
use App\C2beneficiary;
use App\Occupation;
use App\C1Bulk;
// use Storage;
use Illuminate\Support\Facades\Storage;
use App\Imports\BeneficiariesImport;
use App\Imports\newBeneficiariesImport;
use App\Exports\BeneficiaryExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\User;

class BeneficiaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $leaders = User::where('role','!=','elder')->get();

        return view('beneficiaries/beneficiaries',compact('leaders'));
    }




    public function index_c2()
    {
        $beneficiary = C2Beneficiary::all();
        return view('beneficiaries/c2beneficiaries', [
            'beneficiary'=>$beneficiary,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $education =Education::all();
        $benefits = Welfare::all();
        $c1_benefits = Welfare::where('component_id', 1)->get();
        $status = Status::all();
        $states = State::all();
        $sectors = Sector::all();
        $components = Component::all();
        $lgas = Lga::all();
        $community = Community::all();
        $occupations = DB::table('occupations')->get();
        $leaders = User::where('role','=','elder')->get();

        // print_r($occupations); exit();

        return view(
            'beneficiaries/create-beneficiaries',
            compact(
                'education',
                'benefits',
                'status',
                'sectors',
                'components',
                'states',
                'lgas',
                'community',
                'occupations',
                'c1_benefits',
                'leaders'
            )
        );
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_c2()
    {
        // $education =Education::all();
        $benefits = Welfare::where('component_id', 2)->get();

        // print_r($benefits); exit();


        // $status = Status::all();
        // $states = State::all();
        // $lgas = Lga::all();
        // $components = Component::all();
        return view(
            'beneficiaries/create-c2-beneficiaries',
            compact(
                // 'education',
                'benefits',
                // 'status',
                // 'states',
                // 'lgas',
                // 'components'
            )
        );
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->ValidateBeneficiary();

             //Handle file upload
             if ($request->hasFile('identity')) {
                //Get file with extension
                $fileNameWithExt = $request->file('identity')->getClientOriginalName();
                //Get just file name
                $filename = pathinfo($fileNameWithExt,PATHINFO_FILENAME);
                //Get just ext
               $extension = $request->file('identity')->getClientOriginalExtension();
                //File to store
                $fileNameToStore =  $filename.'_'.time().'.'.$extension;
                //Upload the image
                $path = $request->file('identity')->storeAs('public/identity', $fileNameToStore);

           } else {
            $fileNameToStore = 'noImage.jpg';
           }

        try {
            $beneficiary = new Beneficiary(request([
                'firstname',
                'middlename',
                'lastname',
                'gender',
                'age',
                'occupation',
                'phone',
                'education_id',
                'benefit_id',
                'status_id',
                'state_id',
                'lga_id',
                'ward_id',
                'identity',
                'sector_id',
                'component_id',

            ]));
            // $beneficiary->slug = Str::uuid();
          $beneficiary->save();

            return back()->with('success', 'New Beneficiary added  successfully');
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_c2(Request $request)
    {
        // $this->ValidateBeneficiary();

        try {
            $c2beneficiary = new C2Beneficiary(request([
                'benefit_id',
                // 'beneficiaries',
            ]));

            $benefit = Welfare::find($request->benefit_id);

            $c2beneficiary->beneficiaries =  $benefit->default_number;
            $c2beneficiary->save();
            return back()->with('success', 'New C2 Beneficiary added  successfully');
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $beneficiary = Beneficiary::where('id', $id)->first();
        $education =Education::all();
        $benefits = Welfare::all();
        $status = Status::all();
        $states = State::all();
        $lgas = Lga::all();
        $community = Community::all();
        return view(
            'beneficiaries/edit-beneficiaries',
            compact(
                'beneficiary',
                'education',
                'benefits',
                'status',
                'states',
                'lgas',
                'community'
            )
        );
    }


    public function edit_c2($id)
    {
        $beneficiary = C2Beneficiary::where('id', $id)->first();
        $benefits = Welfare::all();
        return view(
            'beneficiaries/edit-c2beneficiaries',
            compact(
                'beneficiary',
                'benefits',
            )
        );
    }
    public function view($id){

        $beneficiary = Beneficiary::find($id);

        return view(
            'beneficiaries/view',
            compact(
                'beneficiary',
            )
        );

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
        $this->ValidateBeneficiary();
        try {
            $beneficiary = Beneficiary::find($request->id);
            $beneficiary->update([
            'firstname' => $request->firstname,
            'middlename'=> $request->middlename,
            'lastname' =>$request->lastname,
            'gender'=>$request->gender,
            'age'=>$request->age,
            'occupation'=>$request->occupation,
            'phone'=>$request->phone,
            'education_id'=>$request->education_id,
            'benefit_id'=>$request->benefit_id,
            'status_id'=>$request->status_id,
            'state_id'=>$request->state_id,
            'lga_id'=>$request->lga_id,
            'ward_id'=>$request->ward_id,
            'community_id'=>$request->community_id,
        ]);
            return redirect(route('beneficiary.index'))->with('success', 'Beneficiary updated successfully');
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }


    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update_c2(Request $request)
    {
        $this->ValidateBeneficiary();
        try {
            $beneficiary = Beneficiary::find($request->id);
            $beneficiary->update([
            'benefit_id'=>$request->benefit_id,
            'status_id'=>$request->status_id,
            'state_id'=>$request->state_id,
            'lga_id'=>$request->lga_id,
            'community_id'=>$request->community_id,
        ]);
            return redirect(route('beneficiary.index'))->with('success', 'Beneficiary updated successfully');
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
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
        $beneficiary = Beneficiary::where('id', $id)->first();
        if ($beneficiary) {
            $beneficiary->delete();
            return redirect('/beneficiary/list')->with('success', 'Beneficiary removed!');
        } else {
            return redirect('/beneficiary/list')->with('error', 'Beneficiary  not found');
        }
    }

    /**
     * Get Deleted Beneficiary
     */
    public function getDeletedBeneficiaries()
    {
        $beneficiary = Beneficiary::onlyTrashed()->get();
        return view('beneficiaries.deleted', compact('beneficiary'));
    }

    /**
     * Restore Deleted beneficiary
     */
    public function restoreDeletedBeneficiaries($id)
    {
        try {
            $beneficiary = Beneficiary::where('id', $id)->withTrashed()->first();
            $beneficiary->restore();
            return redirect(route('beneficiary.index'))
                        ->with('success', 'Beneficiary restored successfully');
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    /**
     * Permanently delete beneficiary
     */
    public function permanentlyDeleteBeneficiary($id)
    {
        try {
            $beneficiary = Beneficiary::where('id', $id)->withTrashed()->first();
            $beneficiary->forceDelete();
            return redirect(route('beneficiary.index'))
                    ->with('success', 'Permanently deleted beneficiary successfully');
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    protected function ValidateBeneficiary()
    {
        return request()->validate(
            [
                'firstname'=>'required|string|',
                'middlename'=>'string|',
                'lastname'=>'required|string|',
                'gender'=>'required|string',
                'age'=>'required',
                'occupation'=>'required|string',
                // 'phone'=>'string',
                'education_id'=>'required',
                'benefit_id'=>'required',
                'status_id'=>'required',
                'state_id'=>'required',
                'lga_id'=>'required',
                // 'community_id'=>'required',
            ]
        );
    }

    public function store_bulk_training(Request $request)
    {
        $request->validate([
            'state_id'=>'required',
            'benefit_id'=>'required',
            'date'=>'required',
            'female_participants'=>'required',
            'male_participants'=>'required'
        ]);


        try {
            $c1_bulk = new C1Bulk(request([
                'state_id',
                'date',
                'female_participants',
                'male_participants'
            ]));
            $c1_bulk->welfare_id = $request->benefit_id;
            $c1_bulk->save();
            return back()->with('success', 'Record Added Successfully');
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    public function c1_bulks()
    {
        $c1_bulks = C1Bulk::paginate(500);
        return view('beneficiaries.c1-bulk', compact('c1_bulks'));
    }

    public function edit_c1_bulks($id)
    {
        $c1_bulk = C1Bulk::find($id);
        $c1_benefits = Welfare::where('component_id', 1)->get();
        $states = State::all();
        return view('beneficiaries.edit-c1bulk', compact('c1_bulk', 'states', 'c1_benefits'));
    }
    public function update_c1_bulks(Request $request, $id)
    {
        $request->validate([
            'state_id'=>'required',
            'benefit_id'=>'required',
            'date'=>'required',
            'female_participants'=>'required',
            'male_participants'=>'required'
        ]);

        $c1_bulk = C1Bulk::find($id);

        $c1_bulk->update([
                'state_id' => $request->state_id,
                'date' => $request->date,
                'welfare_id'=>$request->benefit_id,
                'female_participants' =>$request->female_participants,
                'male_participants' => $request->male_participants
        ]);

        return redirect('/beneficiary/c1-bulk/list');
    }

    public function delete_c1_bulks($id)
    {
        C1Bulk::find($id)->delete();
        return back()->with('success', 'Record Deleted Sucessfully');
    }

    public function download_bulk_template(){
        if(Storage::disk('local')->exists('import/template.xlsx')){
            $path = Storage::disk('local')->path('/import/template.xlsx');
            return response()->download($path);
        }else{
            return back()->with('error', 'There is no file ');

        }



    }

    public function store_bulk_upload(Request $request)
    {


        if($request->has('excel-file')){
         $file = $request->file('excel-file')->store('import');

        $import = new newBeneficiariesImport;
        $import->import($file);

        if ($import->failures()->isNotEmpty()) {
            return back()->withFailures($import->failures());
        }

        return back()->withStatus('Elders uploaded successfully!');
        }else{
            return back()->with('error', 'Please select an excel file');

        }


    }

    public function export(Request $request)
    {
        return Excel::download(new BeneficiaryExport($request), 'beneficairy.xlsx');
    }


    public function make_fks()
    {
        $sn = 1;

        $beneficiaries = Beneficiary::all();

        foreach ($beneficiaries as $ben) {
            if (!is_numeric($ben->lga_id)) {
                $lga = Lga::where('name', $ben->lga_id)->first();

                if ($lga != null) {
                    $ben->update([
                        'lga_id'=>$lga->id,
                    ]);

                    echo '#'.$sn. ' '.$lga->name .' has been replaced by ID => '.$lga->id.'...<br>';

                    $sn++;
                }
            }
        }

        exit("LGAs Updated Successfully!");
    }
}
