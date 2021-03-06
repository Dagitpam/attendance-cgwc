<?php use App\Lga; ?>

@extends('layouts.main')
@section('title', 'attendance')
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
                            <h5>{{ __('Leader Attendances')}}</h5>
                            <span>{{ __('Confirm Attendance')}}</span>
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
                                <a href="#">{{ __('Attendances')}}</a>
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
                        <h3>{{ __('Leader Attendance')}}</h3>
                        {{-- <a type="button" href="/session/create" class="btn btn-warning"> {{ __('Add New')}} <i class="ik ik-plus"></i></a> --}}
                    </div>
                    <div class="card-body">
                        <table id="data_table" class="table">
                            <thead>
                                <tr>
                                    <th>{{__('Session')}}</th>
                                    <th>{{__('Leader name')}}</th>
                                    <th>{{__('Clock in')}}</th>
                                    <th>{{__('Attendance')}}</th>
                                    <th class="nosort">{{ __('Confirmation')}}</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse ($attendances as $attendance)


                                <tr>
                                    <td>{{$attendance->session->name}}</td>
                                    <td>{{$attendance->user->name}}</td>
                                    <td>{{$attendance->time}}</td>
                                    <td>{{$attendance->attendance}}</td>

                                    <td>
                                        @if ($attendance->isConfirm == 0)
                                        <button type="submit" form="form{{ $attendance->id }}" class="btn btn-primary">{{ __('Confirm')}}</button>
                                        @else
                                        <button type="submit" class="btn btn-success">{{ __('Confirmed ???')}}</button>
                                        @endif
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
    @foreach ($attendances as $item)
    <form action="/attendance/confirmed" method="post" style="display: none" id="form{{ $item->id }}">
        @csrf
        <input type="text" name="session_id" value="{{$item->session->id }}">
        <input type="text" name="user_id" value="{{$item->user_id}}">
    </form>

    @endforeach
    <!-- push external js -->
    @push('script')
    <script src="{{ asset('plugins/DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('js/datatables.js') }}"></script>
    @endpush
@endsection
