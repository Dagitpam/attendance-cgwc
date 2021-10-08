@extends('layouts.main') 
@section('title', 'Indicator Tracker')
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
                        <i class="ik ik-activity bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('Indicator Tracker')}}</h5>
                            <span>{{ __('Update Data')}}</span>
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
                                <a href="#">{{ __('Update Data')}}</a>
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
                    <div class="card-header">
                        <h3>{{ __('Update Data')}}</h3>
                    </div>
                    <div class="card-body">
                        <form class="forms-sample" method="POST" action="/tracker/update" >
                        @csrf
                            <input type="hidden" name="id" value="{{$tracker->id}}">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="state_id">{{ __('State')}}<span class="text-red">*</span></label>
                                        <select id="state_id" name="state_id" class="form-control @error('state_id') is-invalid @enderror">
                                            <option value="">State</option>
                                            <option value="2">Adamawa</option>
                                            <option value="8">Borno</option>
                                            <option value="36">Yobe</option>
                                        </select>
                                        <div class="help-block with-errors"></div>
                                        @error('state_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="indicator">{{ __('Indicators')}}<span class="text-red">*</span></label>
                                        <select id="indicator" name="indicator" class="form-control @error('indicator') is-invalid @enderror">
                                            <option value="">Indicator</option>
                                            @forelse($benefit as $indicator)
                                            <option value="{{$indicator->name}}">{{$indicator->name}}</option>
                                            @empty
                                            There are no indicators available at this moment
                                            @endforelse
                                        </select>
                                        <div class="help-block with-errors"></div>
                                        @error('indicator')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="female">{{ __('Female')}}<span class="text-red">*</span></label>
                                        <input id="female" type="number" class="form-control @error('female') is-invalid @enderror" name="female" value="{{$tracker->female}}" placeholder="Enter number of females">
                                        <div class="help-block with-errors"></div>
                                        @error('female')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="male">{{ __('Male')}}<span class="text-red">*</span></label>
                                        <input id="male" type="number" class="form-control @error('male') is-invalid @enderror" name="male" value="{{$tracker->male}}" placeholder="Enter number of males">
                                        <div class="help-block with-errors"></div>
                                        @error('female')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="other">{{ __('Other')}}<span class="text-red">*</span></label>
                                        <input id="other" type="number" class="form-control @error('other') is-invalid @enderror" name="other" value="{{$tracker->other}}" placeholder="Enter Other indicators">
                                        <div class="help-block with-errors"></div>
                                        @error('other')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">{{ __('Submit')}}</button>
                                        <a href="{{url('tracker/list')}}"  class="btn btn-danger">{{ __('Back')}}</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
    @push('script') 
        <script src="{{ asset('plugins/select2/dist/js/select2.min.js') }}"></script>
         <!--get role wise permissiom ajax script-->
        <script src="{{ asset('js/get-role.js') }}"></script>
    @endpush
@endsection
