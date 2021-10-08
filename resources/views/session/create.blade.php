@extends('layouts.main')
@section('title', 'Add Session')
@section('content')
    <!-- push external head elements to head -->
    @push('head')
        <link rel="stylesheet" href="{{ asset('plugins/select2/dist/css/select2.min.css') }}">
        <script src="{{ asset('plugins/jquery/jquery-3.5.1.min.js') }}"></script>
    @endpush


    <div class="container-fluid">
    	<div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-map-pin bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('Add Session')}}</h5>
                            <span>{{ __('Add new Session')}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{url('dashboard')}}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">{{ __('New Session')}}</a>
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
                <div class="card ">
                    <div class="card-header" style="justify-content:space-between;">
                        <h3>{{ __('Add Session')}}</h3>
                        <a type="button" href="/session/list" class="btn btn-primary">{{ __('View All')}} <i class="ik ik-chevron-right"></i></a>
                    </div>
                    <div class="card-body">
                        <form class="forms-sample" method="POST" action="/session/store" >
                        @csrf
                            {{-- <div class="row"> --}}
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="name">{{ __('Name')}}<span class="text-red">*</span></label>
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="" placeholder="Name of Session" required>
                                        <div class="help-block with-errors"></div>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="date">{{ __('Date')}}<span class="text-red">*</span></label>
                                        <input id="date" type="date" class="form-control @error('date') is-invalid @enderror" name="date"  required>
                                        <div class="help-block with-errors"></div>
                                        @error('date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="date">{{ __('Time')}}<span class="text-red">*</span></label>
                                        <input id="time" type="time" class="form-control @error('time') is-invalid @enderror" name="time"  required>
                                        <div class="help-block with-errors"></div>
                                        @error('time')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="call_time">{{ __('Call Time')}}<span class="text-red">*</span></label>
                                        <input id="call_time" type="time" class="form-control @error('call_time') is-invalid @enderror" name="call_time"  required>
                                        <div class="help-block with-errors"></div>
                                        @error('call_time')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">{{ __('Submit')}}</button>
                                        <a href="{{url('session/list')}}"  class="btn btn-danger">{{ __('Back')}}</a>
                                    </div>
                                </div>
                            {{-- </div> --}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- push external js -->
    @push('script')
        <script src="{{ asset('plugins/select2/dist/js/select2.min.js') }}"></script>
         <!--get role wise permissiom ajax script-->
        <script src="{{ asset('js/get-role.js') }}"></script>
    @endpush
@endsection
