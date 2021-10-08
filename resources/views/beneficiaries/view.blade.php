@extends('layouts.main') 
@section('title', 'View Beneficiary')
@section('content')
    
    <div class="container-fluid">
    	<div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-eye bg-green"></i>
                        <div class="d-inline">
                            <h5>{{ __('View Beneficiary')}}</h5>
                            <span>{{$beneficiary->firstname}} {{$beneficiary->lastname}}</span>
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
                                <a href="#">{{ __('View Beneficiary')}}</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        
        <div class="col-md-12">
            <div class="card" >

                <div class="card-body" id="print">
                    <h3 class="mt-30 text-success text-center"><strong>{{$beneficiary->firstname}} {{$beneficiary->lastname}}</strong></h3>
                    <hr>
                    {{-- <P class="text-center"><label class="badge badge-primary">Project Number: {{$beneficiary->firstname}}</label></P> --}}
                    <br>
                    <div class="row">
                        <div class="col-md-3 col-6"> <strong>{{ __('First name')}}</strong>
                            <br>
                            <p class="text-muted">{{$beneficiary->firstname}}</p>
                        </div>
                        <div class="col-md-3 col-6"> <strong>{{ __('Middle name')}}</strong>
                            <br>
                            <p class="text-muted">{{$beneficiary->middlename}}</p>
                        </div>
                        <div class="col-md-3 col-6"> <strong>{{ __('Last name')}}</strong>
                            <br>
                            <p class="text-muted">{{$beneficiary->lastname}}</p>
                        </div>
                        <div class="col-md-3 col-6"> <strong>{{ __('Gender')}}</strong>
                            <br>
                            <p class="text-muted">{{$beneficiary->gender == 1 ? "Female" : "Male"}}</p>
                        </div>                        
                    </div>
                    <hr>

                    <div class="row">
                        <div class="col-md-3 col-6"> <strong>{{ __('Age')}}</strong>
                            <br>
                            <p class="text-muted">{{$beneficiary->age}}</p>
                        </div>
                        <div class="col-md-3 col-6"> <strong>{{ __('Occupation')}}</strong>
                            <br>
                            <p class="text-muted">{{$beneficiary->occupation}}</p>
                        </div>
                        <div class="col-md-3 col-6"> <strong>{{ __('Phone')}}</strong>
                            <br>
                            <p class="text-muted">{{$beneficiary->phone}}</p>
                        </div>
                        <div class="col-md-3 col-6"> <strong>{{ __('Education')}}</strong>
                            <br>
                            <p class="text-muted">{{$beneficiary->education->education_level}}</p>
                        </div>
                        
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-3 col-6"> <strong>{{ __('Benefit')}}</strong>
                            <br>
                            <p class="text-muted">{{$beneficiary->benefit->name}}</p>
                        </div>
                        <div class="col-md-3 col-6"> <strong>{{ __('Status')}}</strong>
                            <br>
                            <p class="text-muted">{{$beneficiary->status->name}}</p>
                        </div>
                        <div class="col-md-3 col-6"> <strong>{{ __('State')}}</strong>
                            <br>
                            <p class="text-muted">{{$beneficiary->state->name}}</p>
                        </div>
                        <div class="col-md-3 col-6"> <strong>{{ __('LGA')}}</strong>
                            <br>
                            <p class="text-muted">{{$beneficiary->lga->name}}</p>
                        </div>
                        
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-3 col-6"> <strong>{{ __('Ward')}}</strong>
                            <br>
                            <p class="text-muted">{{$beneficiary->ward_id == null ? "Nil" : $beneficiary->ward->name}}</p>
                        </div>
                        <div class="col-md-3 col-6"> <strong>{{ __('Community')}}</strong>
                            <br>
                            <p class="text-muted">{{$beneficiary->community_id == null ? "Nil" : $beneficiary->community->name}}</p>
                        </div>
                        <div class="col-md-6 col-6"> <strong>{{ __('Proof of identity')}}</strong>
                            <br>
                            <img  src="{{asset('storage/identity/'.$beneficiary->identity)}}" alt="" alt="">
                        </div>
                    </div>
                    <hr>

                    {{-- <?=$project->description; ?> --}}
                        {{-- <p class="mt-30">{{ __('Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt.Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim.')}}</p>
                        <p>{{ __('Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries')}} </p>
                        <p>{{ __('It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.')}}</p> --}}


                    {{-- <h4 class="mt-30">{{ __('Skill Set')}}</h4> --}}
                    <hr>
                    {{-- <h6 class="mt-30">{{ __('Wordpress')}} <span class="pull-right">80%</span></h6>
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-success" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width:80%;"> <span class="sr-only">50% Complete</span> </div>
                    </div>
                    <h6 class="mt-30">{{ __('HTML 5')}} <span class="pull-right">90%</span></h6>
                    <div class="progress  progress-sm">
                        <div class="progress-bar bg-info" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width:90%;"> <span class="sr-only">50% Complete</span> </div>
                    </div>
                    <h6 class="mt-30">{{ __('jQuery')}} <span class="pull-right">50%</span></h6>
                    <div class="progress  progress-sm">
                        <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:50%;"> <span class="sr-only">50% Complete</span> </div>
                    </div>
                    <h6 class="mt-30">{{ __('Photoshop')}} <span class="pull-right">70%</span></h6>
                    <div class="progress  progress-sm">
                        <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:70%;"> <span class="sr-only">50% Complete</span> </div>
                    </div> --}}
                </div>
            </div>


            {{-- <div id="print-btn"></div> --}}
            <div class="row">
                <div class="container">
                    <a href="/beneficiary/list" class="btn btn-primary btn-sm"><i class="fa fa-list"></i> Back</a>
                    {{-- <button type="submit"  onClick="window.print()"><i class="fa fa-fw fa-print"></i> Print</button> --}}
                    <button class="btn btn-success btn-sm" onclick="printContent('print');" >Print</button>
                    {{-- <button type="submit" id="submit" class="btn btn-warning btn-sm"><i class="fa fa-fw fa-print"></i> Download as PDF</button> --}}
                </div>
            </div>

        </div>

    </div>
    <script>
        function printContent(el){
        var restorepage = $('body').html();
        var printcontent = $('#' + el).clone();
        $('body').empty().html(printcontent);
        window.print();
        $('body').html(restorepage);
        }
        </script>
@endsection