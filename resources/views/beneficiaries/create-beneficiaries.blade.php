@extends('layouts.main')
@section('title', 'Upload Elders')
@section('content')
<!-- push external head elements to head -->
@push('head')
<link rel="stylesheet" href="{{ asset('plugins/select2/dist/css/select2.min.css') }}">
<script src="{{ asset('plugins/jquery/jquery-3.5.1.min.js') }}"></script>
<link rel="stylesheet" href="{{ asset('plugins/DataTables/datatables.min.css') }}">

@endpush


<div class="container-fluid">
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="ik ik-user-plus bg-blue"></i>
                    <div class="d-inline">
                        <h5>{{ __('Add Elders')}}</h5>
                        <span>{{ __('Add New Elder')}}</span>
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
                            <a href="#">{{ __('Upload Elders Data')}}</a>
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
                    <h3>{{ __('Upload Elders')}}</h3>
                </div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    @if (isset($errors) && $errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        {{ $error }}
                        @endforeach
                    </div>
                    @endif

                    @if (session()->has('failures'))

                    <table class="table table-danger">
                        <tr>
                            <th>Row</th>
                            <th>Attribute</th>
                            <th>Errors</th>
                            <th>Value</th>
                        </tr>

                        @foreach (session()->get('failures') as $validation)
                        <tr>
                            <td>{{ $validation->row() }}</td>
                            <td>{{ $validation->attribute() }}</td>
                            <td>
                                <ul>
                                    @foreach ($validation->errors() as $e)
                                    <li>{{ $e }}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>
                                {{ $validation->values()[$validation->attribute()] }}
                            </td>
                        </tr>
                        @endforeach
                    </table>

                    @endif


                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#demoModal"> <i class="ik ik-upload"></i> {{ __('UPLOAD FROM EXCEL')}}</button>
                    <hr>

                    <table id="data_table" class="table">
                        <thead>
                            <tr>
                                <th>{{__('Leader name')}}</th>
                                <th>{{__('department')}}</th>
                                <th>{{__('Email')}}</th>

                            </tr>
                        </thead>
                        <tbody>

                            @forelse ($leaders as $leader)


                            <tr>
                                <td>{{$leader->name}}</td>
                                <td>{{$leader->department}}</td>
                                <td>{{$leader->email}}</td>


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

<div class="modal fade" id="demoModal" tabindex="-1" role="dialog" aria-labelledby="demoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="demoModalLabel">{{ __('Bulk Upload From Excel')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="/beneficiary/import" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>{{ __('File upload')}}</label><br>
                        <input type="file" name="excel-file" class="file-upload">
                        <a href="/beneficiary/download" class="file-upload-browse btn btn-success" >{{ __('Download')}}</a>
                        <button class="file-upload-browse btn btn-success" type="submit">{{ __('Upload')}}</button>

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                {{-- <button type="button" class="btn btn-danger" data-dismiss="modal">{{ __('Close')}}</button> --}}
                {{-- <button type="button" class="btn btn-primary">{{ __('Save changes')}}</button> --}}
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="enterBulk" tabindex="-1" role="dialog" aria-labelledby="demoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="demoModalLabel">{{ __('Upload Bulk Trainings')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="/beneficiary/c1-bulk" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="date">{{ __('Date')}}<span class="text-red">*</span></label>
                            <input id="date" type="text" class="form-control @error('date') is-invalid @enderror" name="date" value="" placeholder="Enter Training Date" required>
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
                            <select id="state-dropdown2" name="state_id" class="form-control @error('state') is-invalid @enderror" required>
                                <option value="">State</option>
                                @forelse($states as $type)
                                <option value="{{$type->id}}">{{$type->name}}</option>
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
                            <select id="benefit_id" name="benefit_id" class="form-control @error('benefit_id') is-invalid @enderror" required>
                                <option value="">Benefits</option>
                                @forelse($c1_benefits as $type)
                                <option value="{{$type->id}}">{{$type->name}}</option>
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
                            <input id="male_participants" type="text" class="form-control @error('male_participants') is-invalid @enderror" name="male_participants" value="" placeholder="Enter No. of Male Participants" required>
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
                            <input id="female_participants" type="text" class="form-control @error('female_participants') is-invalid @enderror" name="female_participants" value="" placeholder="Enter No. of Female Participants" required>
                            <div class="help-block with-errors"></div>
                            @error('female_participants')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="modal-footer">
                        {{-- <button type="button" class="btn btn-danger" data-dismiss="modal">{{ __('Close')}}</button> --}}
                        <button type="submit" class="btn btn-primary">{{ __('Submit ')}}</button>
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
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script src="{{ asset('plugins/select2/dist/js/select2.min.js') }}"></script>
<!--get role wise permissiom ajax script-->
<script src="{{ asset('js/get-role.js') }}"></script>
<script src="{{ asset('plugins/DataTables/datatables.min.js') }}"></script>
<script src="{{ asset('js/datatables.js') }}"></script>
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


{{-- beneficiary/import --}}
