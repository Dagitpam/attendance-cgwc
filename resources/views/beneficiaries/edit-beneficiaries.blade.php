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
                        <h5>{{ __('Update Beneficiary')}}</h5>
                        <span>{{ __('Update Beneficiary')}}</span>
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
                            <a href="#">{{ __('Update Beneficiary')}}</a>
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
                    <h3>{{ __('Update Beneficiary')}}</h3>
                </div>
                <div class="card-body">
                    <form class="forms-sample" method="POST" action="/beneficiary/update">
                        @csrf
                        <input type="hidden" name="id" value="{{$beneficiary->id}}">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="firstname">{{ __('Firstname')}}<span class="text-red">*</span></label>
                                    <input id="firstname" type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{$beneficiary->firstname}}" placeholder="Enter new beneficiary's firstname" required>
                                    <div class="help-block with-errors"></div>
                                    @error('firstname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="firstname">{{ __('MiddleName')}}<span class="text-red">*</span></label>
                                        <input id="middlename" type="text" class="form-control @error('firstname') is-invalid @enderror" name="middlename" value="{{$beneficiary->middlename}}" placeholder="Enter new beneficiary's MiddleName" required>
                                        <div class="help-block with-errors"></div>
                                        @error('middlename')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="lastname">{{ __('Lastname')}}<span class="text-red">*</span></label>
                                    <input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{$beneficiary->lastname}}" placeholder="Enter new beneficiary's lastname" required>
                                    <div class="help-block with-errors"></div>
                                    @error('lastname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="gender">{{ __('Gender')}}<span class="text-red">*</span></label>
                                    <select id="gender" name="gender" class="form-control @error('gender') is-invalid @enderror">
                                        <option selected>Gender</option>
                                        <option value="2" {{$beneficiary->gender == "2" ? "selected" : ""}}>Male</option>
                                        <option value="1" {{$beneficiary->gender == "1" ? "selected" : ""}}>Female</option>
                                    </select>
                                    <div class="help-block with-errors"></div>
                                    @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="age">{{ __('Age')}}<span class="text-red">*</span></label>
                                    <input id="age" type="text" class="form-control @error('age') is-invalid @enderror" name="age" value="{{$beneficiary->age}}" placeholder="Enter new beneficiary's age" required>
                                    <div class="help-block with-errors"></div>
                                    @error('age')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="occupation">{{ __('Occupation')}}<span class="text-red">*</span></label>
                                    <input id="occupation" type="text" class="form-control @error('occupation') is-invalid @enderror" name="occupation" value="{{$beneficiary->occupation}}" placeholder="Enter new beneficiary's occupation" required>
                                    <div class="help-block with-errors"></div>
                                    @error('occupation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="phone">{{ __('Phone')}}<span class="text-red">*</span></label>
                                    <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{$beneficiary->phone}}" placeholder="Enter new beneficiary's phone number" required>
                                    <div class="help-block with-errors"></div>
                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="education_id">{{ __('Educational Level')}}<span class="text-red">*</span></label>
                                    <select id="education_id" name="education_id" class="form-control @error('education_id') is-invalid @enderror">
                                        <option value="">Education Level</option>
                                        @forelse($education as $level)
                                        <option value="{{$level->id}}">{{$level->education_level}}</option>
                                        @empty
                                        There are no new educational levels available at this moment
                                        @endforelse
                                    </select>
                                    <div class="help-block with-errors"></div>
                                    @error('education_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="benefit_id">{{ __('Benefit')}}<span class="text-red">*</span></label>
                                    <select id="benefit_id" name="benefit_id" class="form-control @error('benefit_id') is-invalid @enderror">
                                        {{-- <option value="">Benefits</option> --}}
                                        @forelse($benefits as $type)
                                        <option value="{{$type->id}}" {{$type->id == $beneficiary->benefit_id ? "selected" : ""}}>{{$type->name}}</option>
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
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="status_id">{{ __('Status')}}<span class="text-red">*</span></label>
                                    <select id="status_id" name="status_id" class="form-control @error('status_id') is-invalid @enderror">
                                        {{-- <option value="">Status</option> --}}
                                        @forelse($status as $type)
                                        <option value="{{$type->id}}" {{$type->id == $beneficiary->status_id ? "selected" : ""}}>{{$type->name}}</option>
                                        @empty
                                        There are no Status types available at this moment
                                        @endforelse
                                    </select>
                                    <div class="help-block with-errors"></div>
                                    @error('status_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="state_id">{{ __('State')}}<span class="text-red">*</span></label>
                                    <select id="state-dropdown" name="state_id" class="form-control @error('state') is-invalid @enderror">
                                        <option value="">State</option>
                                        @forelse($states as $type)
                                        <option value="{{$type->id}}" {{$type->id == $beneficiary->state_id ? "selected" : ""}}>{{$type->name}}</option>
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
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="lga_id">{{ __('LGA')}}<span class="text-red">*</span></label>
                                    <select id="lga-dropdown" name="lga_id" class="form-control @error('lga_id') is-invalid @enderror">

                                    </select>
                                    <div class="help-block with-errors"></div>
                                    @error('lga_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="community_id">{{ __('Community')}}<span class="text-red">*</span></label>
                                    <select id="community_id" name="community_id" class="form-control @error('community_id') is-invalid @enderror">
                                        {{-- <option value="">Community</option> --}}
                                        @forelse($community as $type)
                                        <option value="{{$type->id}}" {{$type->id == $beneficiary->community_id ? "selected" : ""}}>{{$type->name}}</option>
                                        @empty
                                        There are no Communities available at this moment
                                        @endforelse
                                    </select>
                                    <div class="help-block with-errors"></div>
                                    @error('community_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">{{ __('Submit')}}</button>
                                    <a href="{{url('beneficiary/list')}}" class="btn btn-danger">{{ __('Back')}}</a>
                                </div>
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
                url: "{{url('get-lga-by-state')}}"
                , type: "POST"
                , data: {
                    state_id: state_id
                    , _token: '{{csrf_token()}}'
                }
                , dataType: 'json'
                , success: function(result) {
                    $('#lga-dropdown').html('<option value="">Select LGA</option>');
                    $.each(result.lgas, function(key, value) {
                        $("#lga-dropdown").append('<option value="' + value.id + '">' + value.name + '</option>');
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
