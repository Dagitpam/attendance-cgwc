@extends('layouts.main')
@section('title', 'Add New Beneficiary')
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
                        <i class="ik ik-user-plus bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('Add New Beneficiary')}}</h5>
                            <span>{{ __('Component 2')}}</span>
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
                                <a href="#">{{ __('Add C2 Beneficiary')}}</a>
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
                        <h3>{{ __('Add New Component 2 Beneficiary')}}</h3>
                    </div>
                    <div class="card-body">
                        <form class="forms-sample" method="POST" action="/beneficiary/store_c2" >
                        @csrf

                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="benefit">{{ __('Benefit')}}<span class="text-red">*</span></label>
                                        <select id="benefit" name="benefit_id" class="form-control @error('benefit') is-invalid @enderror" required>
                                            <option value="">__Choose__</option>
                                            @foreach ($benefits as $benefit)

                                                <option value="{{$benefit->id}}">{{$benefit->name. ' ( Approx. ' . $benefit->default_number}} beneficiaries )</option>
                                                {{-- <input type="hidden" name="beneficiaries" value="{{$benefit->default_number}}"> --}}
                                            @endforeach
                                        </select>
                                        <div class="help-block with-errors"></div>
                                        @error('benefit')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                            </div>

                            {{-- <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="number">{{ __('Number of beneficiaries')}}<span class="text-red">*</span></label>
                                        <input id="number" type="number" class="form-control @error('number') is-invalid @enderror" name="number" value="" placeholder="eg. 300" required>
                                        <div class="help-block with-errors"></div>
                                        @error('number')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div> --}}

                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">{{ __('Submit')}}</button>
                                    <a href="{{url('beneficiary/list')}}"  class="btn btn-danger">{{ __('Back')}}</a>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
        $('#state-dropdown').on('change', function() {
            var state_id = this.value;
            $("#lga-dropdown").html('');
            $.ajax({
            url:"{{url('get-lga-by-state')}}",
            type: "POST",
            data: {
            state_id: state_id,
            _token: '{{csrf_token()}}'
        },
        dataType : 'json',
        success: function(result){
        $('#lga-dropdown').html('<option value="">Select LGA</option>');
        $.each(result.lgas,function(key,value){
        $("#lga-dropdown").append('<option value="'+value.id+'">'+value.name+'</option>');
         });
         }
        });
      });
    });
    </script>
    <!-- push external js -->
    @push('script')
        <script src="{{ asset('plugins/select2/dist/js/select2.min.js') }}"></script>
         <!--get role wise permissiom ajax script-->
        <script src="{{ asset('js/get-role.js') }}"></script>
    @endpush
@endsection
