@extends('layouts.main') 
@section('title', 'Dashboard')
@section('content')
    <!-- push external head elements to head -->
    @push('head')

        <link rel="stylesheet" href="{{ asset('plugins/weather-icons/css/weather-icons.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/owl.carousel/dist/assets/owl.carousel.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/owl.carousel/dist/assets/owl.theme.default.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/chartist/dist/chartist.min.css') }}">
    @endpush

    <div class="container-fluid">
          
        @include('include.stats')
        


        <div id="map" style="width:100%;height:500px;"></div>

      <script>
      function initMap(){
        //Map options
        var options = {
          zoom: 6,
          center: {lat: 9.0820, lng: 8.6753},
          mapTypeId: 'hybrid' //satellite hybrid roadmap
        }

        //New map
        var map = new google.maps.Map(document.getElementById("map"), options);
          addMarker({
            coords: {lat: 10.62042279, lng:12.18999467},
            content: '<h1>Borno</h1><br><h2><a href="/states/beneficiary/8">View</a></h2>'
          });

          addMarker({
            coords: {lat: 10.2703408, lng: 13.2700231},
            content: '<h1>Adamawa</h1><br><h2><a href="/states/beneficiary/2">View</a></h2>'
          });

          addMarker({
            coords: {lat: 11.74899608, lng: 11.96600457},
            content: '<h1>Yobe</h1><br><h2><a href="/states/beneficiary/36">View</a></h2>'
          });
          
        function addMarker(props){
          var marker = new google.maps.Marker({
          position: props.coords,
          map: map,
          // animation:google.maps.Animation.BOUNCE
        });

        if(props.content){
          var infoWindow = new google.maps.InfoWindow({
         content: props.content
        });

        marker.addListener('click', function(){
        infoWindow.open(map, marker)
        })

        }
        }
      }
      </script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDp2GEH48t3ofO1DfgN2A_w19QVReZi6j0&callback=initMap"></script>

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
       
        
        <script src="{{ asset('js/widget-statistic.js') }}"></script>
        <script src="{{ asset('js/widget-data.js') }}"></script>
        <script src="{{ asset('js/dashboard-charts.js') }}"></script>
        
    @endpush
@endsection