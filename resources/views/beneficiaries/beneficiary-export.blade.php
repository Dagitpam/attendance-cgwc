<?php use App\Status; ?>
<?php use App\Welfare; ?>

<table>
    <thead>
        <tr>
            <th>{{ __('Id')}}</th>
            <th>{{ __('First Name')}}</th>
            {{-- <th>{{ __('Middle Name')}}</th> --}}
            <th>{{ __('Last Name')}}</th>
            <th>{{ __('Gender')}}</th>
            <th>{{ __('Age')}}</th>
            <th>{{ __('Occupation')}}</th>
            {{-- <th>{{ __('Phone')}}</th> --}}
            {{-- <th>{{ __('Education')}}</th> --}}
            <th>{{ __('Benefit')}}</th>
            <th>{{ __('Status')}}</th>
            <th>{{ __('State')}}</th>
            {{-- <th>{{ __('Lga')}}</th> --}}
            {{-- <th>{{ __('Date')}}</th> --}}
            <th class="">{{ __('Action')}}</th>
        </tr>
    </thead>

    <tbody>

        @forelse ($beneficiary as $detail)
        <tr>
            <?php

                                    if($detail->gender == 1){
                                        $gender = "FEMALE";
                                    }elseif($detail->gender == 2){
                                        $gender = "MALE";
                                    }

                                    $status = Status::find($detail->status_id);
                                    if($status == NULL || $status == ""){
                                        $status = "NIL";
                                    }else{
                                        $status = $status->name;
                                    }

                                    $benefit = Welfare::find($detail->benefit_id);
                                    if($benefit == NULL || $benefit == ""){
                                        $benefit = "NIL";
                                    }else{
                                        $benefit = $benefit->name;
                                    }

                                    switch ($detail->state_id) {
                                        case 2:
                                            $state = "ADAMAWA";
                                            break;

                                        case 8:
                                            $state = "BORNO";
                                            break;

                                        case 35:
                                            $state = "YOBE";
                                            break;

                                        default:
                                            $state = "No stated added";
                                            break;
                                    }


                                    switch ($detail->occupation) {
                                        case 1:
                                            $occupation = "CIVIL SERVANT";
                                            break;

                                        case 2:
                                            $occupation = "ENTREPRENEUR";
                                            break;

                                        case 3:
                                            $occupation = "FARMER";
                                            break;

                                        case 4:
                                            $occupation = "STUDENT";
                                            break;

                                        case 5:
                                            $occupation = "OTHERS";
                                            break;

                                        case 6:
                                            $occupation = "UNEMPLOYED";
                                            break;

                                        case 7:
                                            $occupation = "HOMEMAKER";
                                            break;

                                        default:
                                            $state = "";
                                            break;
                                    }

                                ?>
            <td>{{$detail->id}}</td>
            <td>{{$detail->firstname}}</td>
            {{-- <td>{{$detail->middlename}}</td> --}}
            <td>{{$detail->lastname}}</td>
            <td>{{$gender}}</td>
            <td>{{$detail->age}}</td>
            <td>{{$occupation}}</td>
            {{-- <td>{{$detail->phone}}</td> --}}
            {{-- <td>{{$detail->education->education_id}}</td> --}}
            <td>{{$benefit}}</td>
            <td>{{$status}}</td>
            <td>{{$state}}</td>
            {{-- <td>{{$detail->lga->name}}</td> --}}
            {{-- <td>{{$detail->created_at}}</td> --}}

        </tr>
        @empty
        There are no Beneficiaries available at this moment
        @endforelse
    </tbody>
</table>
