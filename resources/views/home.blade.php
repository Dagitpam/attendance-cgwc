<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Bayregistry App - Powered by Rocket Software Ltd</title>
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="icon" href="{{ asset('favicon.png') }}" type="image/x-icon" />

        <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700,800" rel="stylesheet">

        <link rel="stylesheet" href="{{ asset('plugins/bootstrap/dist/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/ionicons/dist/css/ionicons.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/icon-kit/dist/css/iconkit.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}">
        <link rel="stylesheet" href="{{ asset('dist/css/theme.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <script src="{{ asset('src/js/vendor/modernizr-2.8.3.min.js') }}"></script>

        <style>
            .header{
                height: 400px;
                width: 100%;
                background-position: center;
                background-size: cover;
            }

            .main-container{
                width: 400px;
                height: 300px;
                margin: 0 auto;
                background: white;
                margin-top: -200px;
                box-shadow: 0px 3px 15px rgba(0,0,0,0.2);
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                border-radius: 3px;
            }

            .main-container img{
                margin: 0 auto;
                display: inline-block;
            }

            .main-container p{
                margin-top: 15px;
            }

            .main-container a{
                padding: 15px 50px;
                background: #009688;
                margin-top: 15px;
                color: #fff;
                border-radius: 40px;
            }

            .main-container a:hover{
                background: #03564f;
                transition: all 1s;
            }
        </style>
    </head>

    <body>
		<!-- <div class="container">
		    <div class="row justify-content-center">
		        <div class="col-md-12 m-5 text-center">
		        	<a href="http://rakibhstu.com">
		            	<img height="40" src="{{ asset('img/logo.png') }}">
		            </a>
		        </div>
		        <div class="col-md-12 m-5 mt-0 text-center">
		            <h6>Hello <span class="text-danger">Everyone</span>,</h6>
		            <a href="{{url('login')}}" class="btn btn-success">Proceed to Login</a>
		            <br>
		            <br>
		            <br>
		            <hr>
		            <p>Need more help?</p>
                    Rocketwares<br>
		            Email:Admin@rocketwares.com <br>
		        </div>
		        </div>
		    </div>
		</div> -->
        <div class="header" style="background-image: url({{ asset('img/idpborno.jpg') }})">
        </div>
        <div class="main-container">
            <img height="40" src="{{ asset('img/logo.png') }}">
            <p>Hello everyone, </p>
            <a href="{{url('login')}}">Proceed to Login</a>
            <p>Need more help?</p>
            <p style="margin-top: 0">Email:Admin@rocketwares.com</p>
        </div>
		<script src="{{ asset('src/js/vendor/jquery-3.3.1.min.js') }}"></script>
        <script src="{{ asset('plugins/popper.js/dist/umd/popper.min.js') }}"></script>
        <script src="{{ asset('plugins/bootstrap/dist/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('plugins/perfect-scrollbar/dist/perfect-scrollbar.min.js') }}"></script>
        <script src="{{ asset('plugins/screenfull/dist/screenfull.js') }}"></script>

    </body>
</html>

