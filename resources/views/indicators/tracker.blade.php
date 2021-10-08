@extends('layouts.main') 
@section('title', 'Indicators')
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
                        <i class="ik ik-activity bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('Indicator Tracker List')}}</h5>
                            <span>{{ __('Adamawa|Borno|Yobe')}}</span>
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
                                <a href="#">{{ __('')}}</a>
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
                <div class="card">
                    <div class="card-header"><h3>{{ __('Indicators')}}</h3></div>
                    <div class="card-body">
                        <table id="data_table" class="table">
                            <thead>
                                <tr>
                                    <th>{{__('Id')}}</th>
                                    <th>{{__('State')}}</th>
                                    <th>{{ __('Indicator')}}</th>
                                    <th>{{ __('Year')}}</th>
                                    <th>{{ __('Month')}}</th>
                                    <th>{{ __('Male')}}</th>
                                    <th>{{ __('Female')}}</th>
                                    <th>{{ __('Others')}}</th>
                                    <th>{{ __('Total')}}</th>
                                    <th>{{ __('Date & Time')}}</th>
                                    <th class="nosort">{{ __('Actions')}}</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse ($tracker as $indicator)
                                <tr>
                                    <td>{{$indicator->id}}</td>
                                    <td>
                                    @php 
                                       $state = App\State::find($indicator->state_id);
                                    @endphp
                                    {{ $state->name}}
                                    </td>
                                    <td>{{$indicator->indicator}}</td>
                                    <td>
                                    @php
                                        $year = Carbon\Carbon::parse($indicator->created_at)->year;
                                    @endphp 
                                    {{$year}}   
                                    </td>
                                    <td>
                                    @php
                                        $month = Carbon\Carbon::parse($indicator->created_at)->month;
                                        $list = [
                                            'January',
                                            'February',
                                            'March',
                                            'April',
                                            'May',
                                            'June',
                                            'July',
                                            'August',
                                            'September',
                                            'October',
                                            'November',
                                            'December'
                                        ];
                                        $decoded_month = $list[$month-1];
                                    @endphp 
                                    {{$decoded_month}}
                                    </td>
                                    <td>{{$indicator->female}}</td>
                                    <td>{{$indicator->male}}</td>
                                    <td>{{$indicator->other}}</td>
                                    <td>
                                    @php
                                        $total = $indicator->male + $indicator->female;
                                    @endphp
                                    {{$total}}    
                                    </td>
                                    <td>{{$indicator->created_at}}</td>
                                    
                                    <td>
                                        <a href="/tracker/{{$indicator->slug}}/edit"><i class="ik ik-edit-2 f-16 mr-15 text-green">
                                        </i></a>
                                        <a href="/tracker/delete/{{$indicator->slug}}"><i class="ik ik-trash-2 f-16 text-red"></i></a>
                                    </td>
                                </tr>                    
                                @empty
                                There are no indicators available at this moment 
                                @endforelse
                            </tbody>
                        </table>
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
