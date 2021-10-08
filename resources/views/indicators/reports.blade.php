@extends('layouts.main') 
@section('title', 'Reports')
@section('content')
    <!-- push external head elements to head -->
    @push('head')
    <link rel="stylesheet" href="{{ asset('plugins/DataTables/datatables.min.css') }}">
    <script src="{{ asset('plugins/jquery/jquery-3.5.1.min.js') }}"></script>
    @endpush

    
    <div class="container-fluid">
    	<div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-folder bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('Report List')}}</h5>
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
                    <div class="card-header"><h3>{{ __('Reports')}}</h3></div>
                    <div class="card-body">
                        <table id="data_table" class="table">
                            <thead>
                                <tr>
                                    <th>{{__('Id')}}</th>
                                    <th>{{__('State')}}</th>
                                    <th>{{ __('Community')}}</th>
                                    <th>{{ __('Indicator')}}</th>
                                    <th>{{ __('Component')}}</th>
                                    <th>{{ __('Target')}}</th>
                                    <th>{{ __('results')}}</th>
                                    <th>{{ __('Reported by')}}</th>
                                    <th>{{ __('Date & Time')}}</th>
                                    <th class="nosort">{{ __('Actions')}}</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse ($reports as $report)
                                <tr>
                                    <td>{{$report->id}}</td>
                                    <td>
                                    @php 
                                       $state = App\State::find($report->state_id);
                                    @endphp
                                    {{ $state->name}}
                                    </td>
                                    <td>{{$report->community}}</td>
                                    <td>{{$report->indicator}}</td>
                                    <td>{{$report->component}}</td>
                                    <td>{{$report->target}}</td>
                                    <td>{{$report->results}}</td>
                                    <td>{{$report->reported_by}}</td>
                                    <td>{{$report->created_at}}</td>
                                    
                                    <td>
                                        <a href="/report/{{$report->slug}}/show"><i class="ik ik-eye f-16 mr-15 text-blue">
                                        </i></a>
                                        <a href="/report/{{$report->slug}}/edit"><i class="ik ik-edit-2 f-16 mr-15 text-green">
                                        </i></a>
                                        <a href="/report/delete/{{$report->slug}}"><i class="ik ik-trash-2 f-16 text-red"></i></a>
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
        <div class="modal fade edit-layout-modal" id="editLayoutItem" tabindex="-1" role="dialog" aria-labelledby="editLayoutItemLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content message-modal">
                    
                </div>
            </div>
        </div>
    <!-- push external js -->
    @push('script')
    <script src="{{ asset('plugins/DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('js/datatables.js') }}"></script>
    @endpush
@endsection
