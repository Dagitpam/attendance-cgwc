<?php
// use App\State;

?>

@extends('layouts.main')
@section('title', 'Dashboard')
@section('content')
<!-- push external head elements to head -->
@push('head')
<link rel="stylesheet" href="{{ asset('plugins/weather-icons/css/weather-icons.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/owl.carousel/dist/assets/owl.carousel.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/owl.carousel/dist/assets/owl.theme.default.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/chartist/dist/chartist.min.css') }}">
<link href="/mapsvg/css/mapsvg.css" rel="stylesheet">
<link href="/mapsvg/css/nanoscroller.css" rel="stylesheet">
@endpush

<div class="container-fluid">

    @include('include.stats')
    {{-- <a href="/google" class="btn btn-info">Google View</a> --}}
    {{-- <div id="mapsvg"></div> --}}

    <div class="col-xl-12">
        <div class="card proj-progress-card">
            <div class="card-block">
                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <h6>{{ __('Leaders')}}</h6>

                        <h5 class="mb-30 fw-700">70<span class="text-green ml-10">89</span></h5>
                        <div class="progress">
                            <div class="progress-bar bg-green" style="width:{{$status1_percentage}}%"></div>
                        </div>



                    </div>
                    <div class="col-xl-3 col-md-6">
                        <h6>{{ __('Attendance')}}</h6>

                        <h5 class="mb-30 fw-700">{{ number_format($idp_members)}}<span class="text-blue ml-10">{{ round($status2_percentage, 1) }}%</span></h5>
                        <div class="progress">
                            <div class="progress-bar bg-blue" style="width:{{ round($status2_percentage, 1) }}%"></div>
                        </div>



                    </div>
                    <div class="col-xl-3 col-md-6">
                        <h6>{{ __('Attendance')}}</h6>

                        <h5 class="mb-30 fw-700">{{number_format($returnees)}}<span class="text-red ml-10">{{ round($status3_percentage, 1) }}%</span></h5>
                        <div class="progress">
                            <div class="progress-bar bg-red" style="width:{{ round($status3_percentage, 1) }}%"></div>
                        </div>


                    </div>
                    <div class="col-xl-3 col-md-6">
                        <h6>{{ __('Attendance')}}</h6>

                        <h5 class="mb-30 fw-700">{{number_format($goverment_officials)}}<span class="text-orange ml-10">{{ round($status4_percentage, 1) }}%</span></h5>
                        <div class="progress">
                            <div class="progress-bar bg-yellow" style="width:{{ round($status4_percentage, 1) }}%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Project statustic end -->









</div>

<!-- push external js -->
@push('script')
<script src="{{ asset('plugins/owl.carousel/dist/owl.carousel.min.js') }}"></script>
<script src="{{ asset('plugins/chartist/dist/chartist.min.js') }}"></script>
<script src="{{ asset('plugins/flot-charts/jquery.flot.js') }}"></script>
<!-- <script src="{{ asset('plugins/flot-charts/jquery.flot.categories.js') }}"></script> -->
<script src="{{ asset('plugins/flot-charts/curvedLines.js') }}"></script>
<script src="{{ asset('plugins/flot-charts/jquery.flot.tooltip.min.js') }}"></script>

<script src="{{ asset('plugins/amcharts/amcharts.js') }}"></script>
<script src="{{ asset('plugins/amcharts/serial.js') }}"></script>
<script src="{{ asset('plugins/amcharts/themes/light.js') }}"></script>

<script src="{{asset('js/widget-statistic.js') }}"></script>
<script src="{{asset('js/widget-data.js') }}"></script>
<script src="{{asset('js/dashboard-charts.js') }}"></script>
<script src="{{asset('mapsvg/js/jquery.js')}}"></script>
<script src="{{asset('mapsvg/js/jquery.mousewheel.min.js')}}"></script>
<script src="{{asset('mapsvg/js/jquery.nanoscroller.min.js')}}"></script>
<script src="{{asset('mapsvg/js/mapsvg.min.js')}}"></script>
<script type="text/javascript">

// deal-analytic-chart 2
var chart = AmCharts.makeChart("component-analytic", {
        "type": "serial",
        "theme": "light",
        "dataDateFormat": "YYYY-MM-DD",
        "precision": 2,
        "valueAxes": [{
            "id": "v1",
            "position": "left",
            "autoGridCount": false,
            "labelFunction": function(value) {
                return value;
            }
        }, {
            "id": "v2",
            "gridAlpha": 0,
            "autoGridCount": false
        }],
        "graphs": [{
            "id": "g1",
            "valueAxis": "v2",
            "bullet": "round",
            "bulletBorderAlpha": 1,
            "bulletColor": "#FFFFFF",
            "bulletSize": 8,
            "hideBulletsCount": 50,
            "lineThickness": 3,
            "lineColor": "#2ed8b6",
            "title": "Component 1",
            "useLineColorForBulletBorder": true,
            "valueField": "comp1",
            "balloonText": "[[title]]<br /><b style='font-size: 130%'>[[value]] projects</b>"
        }, {
            "id": "g2",
            "valueAxis": "v2",
            "bullet": "round",
            "bulletBorderAlpha": 1,
            "bulletColor": "#FFFFFF",
            "bulletSize": 8,
            "hideBulletsCount": 50,
            "lineThickness": 3,
            "lineColor": "#e95753",
            "title": "Component 2",
            "useLineColorForBulletBorder": true,
            "valueField": "comp2",
            "balloonText": "[[title]]<br /><b style='font-size: 130%'>[[value]] projects</b>"
        }],
        "chartCursor": {
            "pan": true,
            "valueLineEnabled": true,
            "valueLineBalloonEnabled": true,
            "cursorAlpha": 0,
            "valueLineAlpha": 0.2
        },
        "categoryField": "date",
        "categoryAxis": {
            "parseDates": true,
            "dashLength": 1,
            "minorGridEnabled": true
        },
        "legend": {
            "useGraphSettings": true,
            "position": "top"
        },
        "balloon": {
            "borderThickness": 1,
            "shadowAlpha": 0
        },
        "dataProvider": [{
            "date": "2020-03",
            "comp1": 71,
            "comp2": 75
        }, {
            "date": "2020-04",
            "comp1": 80,
            "comp2": 84
        }, {
            "date": "2020-05",
            "comp1": 78,
            "comp2": 83
        }, {
            "date": "2020-07",
            "comp1": 85,
            "comp2": 88
        }, {
            "date": "2020-08",
            "comp1": 87,
            "comp2": 85
        }, {
            "date": "2020-09",
            "comp1": 97,
            "comp2": 88
        }, {
            "date": "2020-10",
            "comp1": 93,
            "comp2": 88
        }, {
            "date": "2020-11",
            "comp1": 85,
            "comp2": 80
        }, {
            "date": "2020-12",
            "comp1": 90,
            "comp2": 85
        }, {
            "date": "2021-01",
            "comp1": 90,
            "comp2": 85
        }, {
            "date": "2021-02",
            "comp1": 90,
            "comp2": 85
        }]
});


var chart = AmCharts.makeChart("states-chart", {
        "type": "serial",
        "theme": "light",
        // "dataDateFormat": "YYYY-MM-DD",
        // "precision": 2,
        "valueAxes": [{
            "id": "v1",
            "fontSize": 0,
            "axisAlpha": 0,
            "lineAlpha": 0,
            "gridAlpha": 0,
            "position": "left",
            "autoGridCount": false,
            "labelFunction": function(value) {
                return value;
                // return "$" + Math.round(value) + "M";
            }
        }],
        "graphs": [{
            "id": "g3",
            "valueAxis": "v1",
            "lineColor": "#2ed8b6",
            "fillColors": "#2ed8b6",
            "fillAlphas": 0.3,
            "type": "column",
            "title": "Projects",
            "valueField": "projects",
            "columnWidth": 0.5,
            "legendValueText": "[[value]]",
            // "legendValueText": "$[[value]]M",
            "balloonText": "[[title]]<br /><b style='font-size: 130%'>[[value]]</b>"
        }, {
            "id": "g4",
            "valueAxis": "v1",
            "lineColor": "#e95753",
            "fillColors": "#e95753",
            "fillAlphas": 0.5,
            "type": "column",
            "title": "Target",
            "valueField": "target",
            "columnWidth": 0.5,
            "legendValueText": "[[value]]",
            "balloonText": "[[title]]<br /><b style='font-size: 130%'>[[value]]</b>"
        },
        {
            "id": "g5",
            "valueAxis": "v1",
            "lineColor": "#2ed8b6",
            "fillColors": "#2ed8b6",
            "fillAlphas": 1,
            "type": "column",
            "title": "Beneficiaries",
            "valueField": "beneficiaries",
            "columnWidth": 0.5,
            "legendValueText": "[[value]]",
            "balloonText": "[[title]]<br /><b style='font-size: 130%'>[[value]]</b>"
        }],
        "chartCursor": {
            "pan": true,
            "valueLineEnabled": true,
            "valueLineBalloonEnabled": true,
            "cursorAlpha": 0,
            "valueLineAlpha": 0.2
        },
        "categoryField": "state",
        "categoryAxis": {
            // "parseDates": true,
            "axisAlpha": 0,
            "lineAlpha": 0,
            "gridAlpha": 0,
            "minorGridEnabled": true,
        },
        "balloon": {
            "borderThickness": 1,
            "shadowAlpha": 0
        },
        "export": {
            "enabled": true
        },
        "dataProvider": [{
            "state": "Borno",
            "projects": 3009,
            "target": parseInt({{$borno}}),
            "beneficiaries": {{$bornoBeneficiaries}}
        }, {
            "state": "Adamawa",
            "projects": 2100,
            "target": parseInt({{$adamawa}}),
            "beneficiaries": {{$adamawaBeneficiaries}}
        }, {
            "state": "Yobe",
            "projects": 2990,
            "target": parseInt({{$yobe}}),
            "beneficiaries": {{$yobeBeneficiaries}}
        }]



    });


</script>
@endpush
@endsection
