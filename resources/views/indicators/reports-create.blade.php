@extends('layouts.main') 
@section('title', 'Report')
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
                        <i class="ik ik-folder bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('Report')}}</h5>
                            <span>{{ __('Add New Report')}}</span>
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
                                <a href="#">{{ __('Add New Report')}}</a>
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
                        <h3>{{ __('Add New Report')}}</h3>
                    </div>
                    <div class="card-body">
                        <form class="forms-sample" method="POST" action="/report/store" enctype="multipart/form-data">
                        @csrf
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
                                        <label for="community">{{ __('Community')}}<span class="text-red">*</span></label>
                                        <select id="communnity" name="community" class="form-control @error('indicator') is-invalid @enderror">
                                            <option value="">Community</option>
                                            @forelse($communities as $community)
                                            <option value="{{$community->name}}">{{$community->name}}</option>
                                            @empty
                                            There are no communities available at this moment
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
                                        <label for="activity">{{ __('Activity')}}<span class="text-red">*</span></label>
                                        <input id="activity" type="text" class="form-control @error('female') is-invalid @enderror" name="activity" value="" placeholder="Enter Activity">
                                        <div class="help-block with-errors"></div>
                                        @error('activity')
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
                                        <label for="component">{{ __('Component')}}<span class="text-red">*</span></label>
                                        <select id="component" name="component" class="form-control @error('indicator') is-invalid @enderror">
                                            <option value="">Component</option>
                                            <option value="component 1">Component 1</option>
                                            <option value="component 2">Component 2</option>
                                        </select>
                                        <div class="help-block with-errors"></div>
                                        @error('component')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="target">{{ __('Target')}}<span class="text-red">*</span></label>
                                        <input id="target" type="text" class="form-control @error('target') is-invalid @enderror" name="target" value="" placeholder="Enter Target">
                                        <div class="help-block with-errors"></div>
                                        @error('target')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="brief">{{ __('Brief')}}<span class="text-red">*</span></label>
                                        <textarea name="description" class="form-control @error('brief') is-invalid @enderror" name="description" rows="10">
                                        
                                        
                                        </textarea>
                                        <div class="help-block with-errors"></div>
                                        @error('description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="results">{{ __('Results')}}<span class="text-red">*</span></label>
                                        <input id="results" type="text" class="form-control @error('target') is-invalid @enderror" name="results" value="" placeholder="Enter Results">
                                        <div class="help-block with-errors"></div>
                                        @error('target')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="challenge">{{ __('Challenge')}}<span class="text-red">*</span></label>
                                        <textarea name="challenge" class="form-control @error('brief') is-invalid @enderror" name="challenge" rows="10">
                                        
                                        
                                        </textarea>
                                        <div class="help-block with-errors"></div>
                                        @error('description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="target">{{ __('Reported By')}}<span class="text-red">*</span></label>
                                        <input id="reported_by" type="text" class="form-control @error('reported_by') is-invalid @enderror" name="reported_by" value="" placeholder="Reported By">
                                        <div class="help-block with-errors"></div>
                                        @error('reported_by')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="photo">{{ __('image')}}<span class="text-red">*</span></label>
                                        <input id="photo" type="file" class="form-control @error('image') is-invalid @enderror" name="image">
                                        <div class="help-block with-errors"></div>
                                        @error('image')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">{{ __('Submit')}}</button>
                                        <a href="{{url('report/list')}}"  class="btn btn-danger">{{ __('Back')}}</a>
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
