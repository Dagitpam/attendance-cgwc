@extends('layouts.main') 
@section('title', 'Restore Beneficiary')
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
                            <h5>{{ __('Restore Beneficiary')}}</h5>
                            <span>{{ __('List of All Deleted Beneficiaries')}}</span>
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
                    <div class="card-header"><h3>{{ __('Beneficiaries')}}</h3></div>
                    <div class="card-body">
                        <table id="data_table" class="table">
                            <thead>
                                <tr>
                                    <th>{{ __('Id')}}</th>
                                    <th>{{ __('Firstname')}}</th>
                                    <th>{{ __('Lastname')}}</th>
                                    <th>{{ __('Gender')}}</th>
                                    <th>{{ __('Age')}}</th>
                                    <th>{{ __('Occupation')}}</th>
                                    <th>{{ __('Phone')}}</th>
                                    <th>{{ __('Education')}}</th>
                                    <th>{{ __('Benefit')}}</th>
                                    <th>{{ __('Status')}}</th>
                                    <th>{{ __('State')}}</th>
                                    <th>{{ __('Lga')}}</th>
                                    <th class="nosort">{{ __('Action')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse ($beneficiary as $detail)
                            <tr>
                                <td>{{$detail->id}}</td>
                                <td>{{$detail->firstname}}</td>
                                <td>{{$detail->lastname}}</td>
                                <td>{{$detail->gender}}</td>
                                <td>{{$detail->age}}</td>
                                <td>{{$detail->occupation}}</td>
                                <td>{{$detail->phone}}</td>
                                <td>{{$detail->education->education_level}}</td>
                                <td>{{$detail->benefit->name}}</td>
                                <td>{{$detail->status->name}}</td>
                                <td>{{$detail->state->name}}</td>
                                <td>{{$detail->lga->name}}</td>
                                <td>
                                    <a href="/beneficiary/trashed/{{$detail->slug}}"><i class="ik ik-check-square f-16 mr-15 text-green"></i></a>
                                    <a href="/beneficiary/permanent/{{$detail->slug}}"><i class="ik ik-trash-2 f-16 text-red"></i></a>
                                </td>
                            </tr>                    
                            @empty
                            There are no deleted Beneficiaries available at this moment 
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
