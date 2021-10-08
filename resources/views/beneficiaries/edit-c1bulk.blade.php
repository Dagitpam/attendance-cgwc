@extends('layouts.main')
@section('title', 'Update Beneficiary')
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
                        <h5>{{ __('Update C1 Bulk')}}</h5>
                        <span>{{ __('Update C1 Bulk')}}</span>
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
                            <a href="#">{{ __('Update C1 Bulk')}}</a>
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
                    <h3>{{ __('Update C1 Bulk')}}</h3>
                </div>
                <div class="card-body">
                    <form action="/beneficiary/c1-bulk/update/{{$c1_bulk->id}}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="date">{{ __('Date')}}<span class="text-red">*</span></label>
                                <input id="date" type="text" class="form-control @error('date') is-invalid @enderror" name="date" value="{{$c1_bulk->date}}" placeholder="Enter Training Date" required>
                                <div class="help-block with-errors"></div>
                                @error('date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="state_id">{{ __('State')}}<span class="text-red">*</span></label>
                                <select id="state-dropdown" name="state_id" class="form-control @error('state') is-invalid @enderror">
                                    <option value="">State</option>
                                    @forelse($states as $type)
                                    <option value="{{$type->id}}" {{$type->id == $c1_bulk->state_id ? 'selected':''}}>{{$type->name}}</option>
                                    @empty
                                    There are no States available at this moment
                                    @endforelse
                                </select>
                                <div class="help-block with-errors"></div>
                                @error('state_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="benefit_id">{{ __('Benefit')}}<span class="text-red">*</span></label>
                                <select id="benefit_id" name="benefit_id" class="form-control @error('benefit_id') is-invalid @enderror">
                                    <option value="">Benefits</option>
                                    @forelse($c1_benefits as $type)
                                    <option value="{{$type->id}}" {{$type->id == $c1_bulk->welfare_id ? 'selected':''}}>{{$type->name}}</option>
                                    @empty
                                    There are no Benefits available at this moment
                                    @endforelse
                                </select>
                                <div class="help-block with-errors"></div>
                                @error('benefit_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="male_participants">{{ __('Male Participants')}}<span class="text-red">*</span></label>
                                <input id="male_participants" type="text" class="form-control @error('male_participants') is-invalid @enderror" name="male_participants" value="{{$c1_bulk->male_participants}}" placeholder="Enter No. of Male Participants" required>
                                <div class="help-block with-errors"></div>
                                @error('male_participants')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="female_participants">{{ __('Female Participants')}}<span class="text-red">*</span></label>
                                <input id="female_participants" type="text" class="form-control @error('female_participants') is-invalid @enderror" name="female_participants" value="{{$c1_bulk->female_participants}}" placeholder="Enter No. of Female Participants" required>
                                <div class="help-block with-errors"></div>
                                @error('female_participants')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        {{-- <button type="button" class="btn btn-danger" data-dismiss="modal">{{ __('Close')}}</button> --}}
                        <button type="submit" class="btn btn-primary">{{ __('Submit ')}}</button>

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
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endpush
<script>
    $(function() {
        $('input[name="date"]').daterangepicker({
            opens: 'left'
        }, function(start, end, label) {
            console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
        });
    });

</script>
@endsection
