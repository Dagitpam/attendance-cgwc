<?php use App\Lga; ?>

@extends('layouts.main')
@section('title', 'Sessions')
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
                        <i class="ik ik-map-pin bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('Sessions')}}</h5>
                            <span>{{ __('List of Sessions')}}</span>
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
                                <a href="#">{{ __('Sessions')}}</a>
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
                    <div class="card-header" style="justify-content:space-between;">
                        <h3>{{ __('Sessions')}}</h3>
                        <a type="button" href="/session/create" class="btn btn-warning"> {{ __('Add New')}} <i class="ik ik-plus"></i></a>
                    </div>
                    <div class="card-body">
                        <table id="data_table" class="table">
                            <thead>
                                <tr>
                                    <th>{{__('Id')}}</th>
                                    <th>{{__('Name')}}</th>
                                    <th>{{__('Date')}}</th>
                                    <th>{{__('Time')}}</th>
                                    <th>{{__('Call Time')}}</th>
                                    <th class="nosort">{{ __('Actions')}}</th>
                                </tr>
                            </thead>
                            <tbody>
{{-- dd --}}
                                @forelse ($sessions as $session)


                                <tr>
                                    <td>{{$session->id}}</td>
                                    <td>{{$session->name}}</td>
                                    <td>{{$session->date}}</td>
                                    <td>{{$session->time}}</td>
                                    <td>{{$session->call_time}}</td>
                                    <td>
                                        <a href="/session/edit/{{$session->id}}"><i class="ik ik-edit-2 f-16 mr-15 text-green"></i></a>
                                       <a href="/session/delete/{{$session->id}}"><i class="ik ik-trash-2 f-16 text-red"></i></a>
                                    </td>
                                </tr>
                                @empty
                                There are no session available at this moment
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
