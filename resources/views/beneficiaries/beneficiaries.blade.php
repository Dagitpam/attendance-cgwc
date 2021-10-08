<?php use App\Status; ?>
<?php use App\Welfare; ?>
<?php use App\Lga; ?>


@extends('layouts.main')
@section('title', 'Beneficiaries List')
@section('content')
<!-- push external head elements to head -->
@push('head')
<link rel="stylesheet" href="{{ asset('plugins/DataTables/datatables.min.css') }}">
@endpush


<div class="container-fluid">
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="ik ik-users bg-blue"></i>
                    <div class="d-inline">
                        <h5>{{ __('Beneficiaries List')}}</h5>
                        <span>{{ __('List of All Beneficiaries')}}</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <nav class="breadcrumb-container" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{route('dashboard')}}"><i class="ik ik-home"></i></a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#">{{ __('Beneficiaries')}}</a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="row">

        <!-- start message area-->
        @include('include.message')
        <!-- end message area-->
        <div class="col-md-12">
            <div class="card p-3">
                <div class="card-header" style="justify-content:space-between;">
                    <h3>{{ __('Beneficiaries')}}</h3>
                    <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#appsModal">{{ __('Filter and Export')}}</button>
                </div>
                <div class="card-body">
                    <table id="data_table" class="table">
                        <thead>
                            <tr>
                                <th>{{ __('Id')}}</th>
                                <th>{{ __('First Name')}}</th>
                                <th>{{ __('Last Name')}}</th>
                                <th>{{ __('Gender')}}</th>
                                <th>{{ __('Age')}}</th>
                                {{-- <th>{{ __('Occupation')}}</th> --}}
                                <th>{{ __('Benefit')}}</th>
                                <th>{{ __('Status')}}</th>
                                <th>{{ __('State')}}</th>
                                {{-- <th>{{ __('LGA')}}</th> --}}
                                <th class="nosort">{{ __('Action')}}</th>
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

                                    $lga = Lga::find($detail->lga_id);

                                ?>
                                <td>{{$detail->id}}</td>
                                <td>{{$detail->firstname}}</td>
                                <td>{{$detail->lastname}}</td>
                                <td>{{$detail->gender == 1 ? "Female" : "Male"}}</td>
                                <td>{{$detail->age}}</td>
                                {{-- <td>{{$occupation}}</td> --}}
                                <td>{{$benefit}}</td>
                                <td>{{$status}}</td>
                                <td>{{$state}}</td>
                                {{-- <td>{{$lga->name}}</td> --}}
                                <td>
                                    <a href="/beneficiary/view/{{$detail->id}}"><i class="ik ik-eye f-16 text-blue"></i></a>
                                    <a href="/beneficiary/edit/{{$detail->id}}"><i class="ik ik-edit-2 f-16 mr-15 text-green"></i></a>
                                    <a href="/beneficiary/delete/{{$detail->id}}"><i class="ik ik-trash-2 f-16 text-red"></i></a>
                                </td>
                            </tr>
                            @empty
                            There are no Beneficiaries available at this moment
                            @endforelse
                        </tbody>
                    </table>

                    <span>
                        {{$beneficiary->links()}}
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
 $(document).ready(function() {
        $('body').on('change','#state-dropdown', function() {
            var state_id = this.value;
            $("#lga-dropdown").html('');
            $.ajax({
                url: "{{url('get-lga-by-state')}}"
                , type: "POST"
                , data: {
                    state_id: state_id
                    , _token: '{{csrf_token()}}'
                }
                , dataType: 'json'
                , success: function(result) {
                    $('#lga-dropdown').html('<option value="">Select LGA</option>');
                    $.each(result.lgas, function(key, value) {
                        $("#lga-dropdown").append('<option value="' + value.id + '">' + value.name + '</option>');
                    });
                }
            });
        });
    });
</script>
@include('include.filtermodal')
<!-- push external js -->
@push('script')
<script src="{{ asset('plugins/DataTables/datatables.min.js') }}"></script>
<script src="{{ asset('js/datatables.js') }}"></script>

@endpush
@endsection
