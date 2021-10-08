<?php use App\Welfare; ?>

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
                    <div class="card-header"><h3>{{ __('Component 2 Beneficiaries')}}</h3></div>
                    <div class="card-body">
                        <table id="data_table" class="table">
                            <thead>
                                <tr>
                                    <th>{{ __('Id')}}</th>
                                    <th>{{ __('Benefit')}}</th>
                                    <th>{{ __('Number of Benefiaries')}}</th>
                                    <th>{{ __('Date')}}</th>
                                    <th class="nosort">{{ __('Action')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse ($beneficiary as $detail)
                            <tr>
                                <?php $benefit = Welfare::find($detail->benefit_id); ?>
                                <td>{{$detail->id}}</td>
                                <td>{{$benefit->name}}</td>
                                <td>{{$detail->beneficiaries}}</td>
                                <td>{{$detail->created_at}}</td>
                                <td>
                                    <a href="/beneficiary/edit-c2/{{$detail->id}}"><i class="ik ik-edit-2 f-16 mr-15 text-green"></i></a>
                                    <a href="/beneficiary/delete/{{$detail->slug}}"><i class="ik ik-trash-2 f-16 text-red"></i></a>
                                </td>
                            </tr>
                            @empty
                            There are no Beneficiaries available at this moment
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- push external js -->
    @push('script')
    <script src="{{ asset('plugins/DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('js/datatables.js') }}"></script>

    @endpush
@endsection
