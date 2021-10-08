<?php

namespace App\Imports;

use App\User;

use Throwable;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Events\AfterImport;
use Maatwebsite\Excel\Validators\Failure;
use Illuminate\Support\Facades\Hash;



class newBeneficiariesImport implements
ToModel, WithHeadingRow, SkipsOnError, WithValidation, SkipsOnFailure,
WithBatchInserts
{
    use Importable;
    use SkipsErrors;
    use SkipsFailures;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {



        return new User([
            //
            'name' => $row['name'],
            'email' => $row['email'],
            "department" => $row['department'],
            'role' => 'elder',
            'password' => Hash::make($row['password']),

        ]);
    }

  public function rules(): array{
      return [
        'name'=>'required|string|',
        'email'=>'string|required',
        'department'=>'required|string|',
        'password'=>'required',

      ];
  }

  function batchSize(): int
  {
      return 1000;
  }

//   function chunkSize(): int
//   {
//       return 1000;
//   }



}
