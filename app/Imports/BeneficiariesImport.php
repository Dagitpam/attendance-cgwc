<?php

namespace App\Imports;

use App\Beneficiary;
use App\Occupation;
use App\Education;
use App\Welfare;
use App\Status;
use App\State;
use App\Lga;
use App\Community;

use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Events\AfterImport;
use Maatwebsite\Excel\Validators\Failure;
use Throwable;

class BeneficiariesImport implements
ToCollection,
WithHeadingRow,
// SkipsOnError,
// WithValidation,
SkipsOnFailure,
// WithChunkReading,
// ShouldQueue,
WithEvents

{

    // /**
    // * @param array $row
    // *
    // * @return \Illuminate\Database\Eloquent\Model|null
    // */
    use Importable, SkipsErrors, SkipsFailures, RegistersEventListeners;

    public function collection(Collection $rows)
    {

        // print_r($rows); exit();

        foreach ($rows as $row) {

            // convert gender value to foreign key
            if(strtoupper($row['gender']) == "FEMALE" || strtoupper($row['gender']) == "F"){
                $gender = 1;
            }elseif(strtoupper($row['gender']) == "MALE" || strtoupper($row['gender']) == "M"){
                $gender = 2;
            }else{
                echo "<script>
                        alert('Error: Check that gender is correctly entered.(Use: FEMALE or F, MALE or M)');
                    </script>";
            }

            // convert occupations value to foreign key
            $occupations = DB::table('occupations')->get();

            // print_r( $occupations); exit();
            foreach($occupations as $o){

                if(strtoupper($row['occupation']) == strtoupper($o->name)){
                    $occupation = $o->id;
                    break;
                }
            }

            // convert education value to foreign key
            $education_levels = DB::table('education')->get();
            foreach($education_levels as $ed){

                if(strtoupper($row['education']) == strtoupper($ed->education_level)){
                    $education = $ed->id;
                    break;
                }
            }

            // convert Benefits value to foreign key
            $benefits = Welfare::all();
            foreach($benefits as $ben){

                if($row['benefit'] == $ben->name){
                    $benefit = $ben->id;
                    break;
                }
            }

            // convert gender value to foreign key
            $statuses = Status::all();
            foreach($statuses as $stat){

                if($row['status'] == $stat->name){
                    $status = $stat->id;
                    break;
                }
            }


            // convert gender value to foreign key
            $states = DB::table('states')->get();
            foreach($states as $s){

                if(strtoupper($row['state']) == strtoupper($s->name)){
                    $state = $s->id;
                    break;
                }
            }

            // convert gender value to foreign key
            $lgas = DB::table('lgas')->get();
            foreach($lgas as $l){

                if(strtoupper($row['lga']) == strtoupper($l->name)){
                    $lga = $l->id;
                    break;
                }elseif($row['lga'] == "" || $row['lga'] == NULL){
                    $lga = "";
                    break;
                }
            }


            // convert gender value to foreign key
            // $communities = DB::table('communities')->get();
            // if($communities ==  null){
            //     exit("NULLLL");
            // }else{
            //     print_r($communities); exit();
            // }
            // print_r($communities); exit();
            // foreach($communities as $comm){

            //     if($row['Community'] == "" || $row['Community'] == NULL){
            //         $community = "";
            //         break;
            //     }elseif(strtoupper($row['community']) == strtoupper($comm->name)){
            //         $community = $comm->id;
            //         break;
            //     }
            // }



            $beneficiary = Beneficiary::create([
                'firstname' => $row['first_name'],
                'middlename' => $row['middle_name'],
                'lastname' => $row['last_name'],
                'gender' => $gender,
                'age' => $row['age'],
                'occupation' => $occupation,
                'phone' => $row['phone'],
                'education_id' => $education,
                'benefit_id' => $benefit,
                'status_id' => $status,
                'state_id' => $state,
                'lga_id' => $lga,

            ]);


        }
    }

    // public function rules(): array
    // {
    //     return [
    //         '*.email' => ['email', 'unique:users,email']
    //     ];
    // }


    // public function chunkSize(): int
    // {
    //     return 1000;
    // }

    public static function afterImport(AfterImport $event)
    {
    }

    public function onFailure(Failure ...$failure)
    {
    }
}
