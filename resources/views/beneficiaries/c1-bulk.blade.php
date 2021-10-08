<?php use App\Status; ?>
<?php use App\Welfare; ?>
<?php use App\Lga; ?>


@extends('layouts.main')
@section('title', 'Trainings')
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
                        <h5>{{ __('C1 Bulk')}}</h5>
                        <span>{{ __('List of All C1 Bulk')}}</span>
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
                            <a href="#">{{ __('C1 Bulk')}}</a>
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
                    <h3>{{ __('C1 Trainings')}}</h3>
                </div>
                <div class="card-body">
                    <table id="data_table" class="table">
                        <thead>
                            <tr>
                                <th>{{ __('Id')}}</th>
                                <th>{{ __('State')}}</th>
                                {{-- <th>{{ __('Middle Name')}}</th> --}}
                                <th>{{ __('C1 Trainings')}}</th>
                                <th>{{ __('No. Male Participants')}}</th>
                                <th>{{ __('No. Female Participants')}}</th>
                                <th>{{ __('Total Participants')}}</th>
                                <th>{{ __('Date')}}</th>
                                <th class="nosort">{{ __('Action')}}</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse ($c1_bulks as $detail)
                            <tr>
                                
                                <td>{{$detail->id}}</td>
                                <td>{{$detail->state->name}}</td>
                                {{-- <td>{{$detail->middlename}}</td> --}}
                                <td>{{$detail->welfare->name}}</td>
                                <td>{{$detail->male_participants}}</td>
                                <td>{{$detail->female_participants}}</td>
                                <td>{{$detail->female_participants + $detail->male_participants}}</td>
                                <td>{{$detail->date}}</td>
                                
                                <td>
                                    {{-- <a data-toggle="modal" data-target="#enterBulk"><i class="ik ik-edit-2 f-16 mr-15 text-green"></i></a> --}}
                                    <a href="/beneficiary/c1-bulk/edit/{{$detail->id}}"><i class="ik ik-edit-2 f-16 mr-15 text-green"></i></a>
                                    <a href="/beneficiary/c1-bulk/delete/{{$detail->id}}"><i class="ik ik-trash-2 f-16 text-red"></i></a>
                                    {{-- <a href="/beneficiary/delete/{{$detail->slug}}"><i class="ik ik-trash-2 f-16 text-red"></i></a> --}}
                                </td>
                            </tr>
                            @empty
                            There are no Beneficiaries available at this moment
                            @endforelse
                        </tbody>
                    </table>

                    <span>
                        {{$c1_bulks->links()}}
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<!-- push external js -->
@push('script')
<script src="{{ asset('plugins/DataTables/datatables.min.js') }}"></script>
<script src="{{ asset('js/datatables.js') }}"></script>

@endpush
@endsection




