@extends('layouts.main') 
@section('title', 'State')
@section('content')
    
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-file-text bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('Indicator')}}</h5>
                            @foreach($indicator as $id)
                            <span>
                            @php 
                                $state = App\State::find($id->state_id);
                            @endphp
                            {{ $state->name}}
                            </span>
                           @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="/tracker/dashboard"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">{{ __('Dashboard')}}</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('Dashboard')}}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                @foreach($indicator->chunk(3) as $row)
                <div class="row layout-wrap" id="layout-wrap">
                  @foreach($row as $detail)
                    <div class="card bg-info mb-3 text-center" style="width: 22rem; margin:80px">
                         <div class="card-body">
                                <h1 class="card-title">{{$detail->indicator}}</h1>
                        <p class="card-text">
                            @php
                                $total = $detail->male + $detail->female;
                            @endphp
                            {{$total}}
                        </p>
                        <p>
                        <form method="GET" action="/tracker/indicator">
                            <input type="hidden" name="indicator" value="{{$detail->indicator}}">
                            <button type="submit" class="btn btn-dark btn-lg">More</button>
                        </form>
                        </p>
                        </div>
                    </div>
                   @endforeach
                </div>
              @endforeach
            </div>
        </div>
    </div>
                
    <!-- push external js -->
    @push('script')

        <script src="{{ asset('plugins/sweetalert/dist/sweetalert.min.js') }}"></script>
        <script src="{{ asset('plugins/summernote/dist/summernote-bs4.min.js') }}"></script>
        <script src="{{ asset('js/layouts.js') }}"></script>
    @endpush
@endsection
    