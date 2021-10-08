@extends('layouts.main')
@section('title', 'Dashboard')
@section('content')
<!-- push external head elements to head -->
@push('head')

<link rel="stylesheet" href="{{ asset('plugins/weather-icons/css/weather-icons.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/owl.carousel/dist/assets/owl.carousel.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/owl.carousel/dist/assets/owl.theme.default.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/chartist/dist/chartist.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/bootstrap/dist/css/bootstrap.min.css') }}">
<style>
    #hero{
        height: 300px;
        background: linear-gradient(0deg, rgba(0, 0, 0, 0.6), rgba(255, 0, 150, 0.6)), url(https://images.unsplash.com/photo-1546017535-ed107a04ac7b?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=750&q=80);
        background-repeat: no-repeat;
        background-position: center center;
        background-size: cover;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        color: white;
        text-align: center;
        margin-bottom: 20px;
    }

    #hero h1{
        font-size: 40px;
        font-weight: 900;
    }

    #hero p{
        font-size: 20px;
        font-weight: 400;
    }
</style>
<script src="{{ asset('plugins/jquery/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('js/chartlayout.js') }}"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
@endpush
{{-- <div class="container-fluid">
    @include('include.stats')
</div> --}}
<div>
    <div id="hero">
        <h1>RESULTS</h1>
        <p>RESULT DASHBOARD, FINANCIAL ANALYSIS & PROJECTS ANALYTICS</p>
    </div>

    <div class="row">

        <div class="col-xl-6 col-md-6">
            <div class="card sale-card" >
                <div class="card-header">
                    <h3>{{ __('Financial Progress')}}</h3>
                </div>
                <div class="card-block text-center">
                    <div data-label="{{$financial_progress_bay}}%" class="radial-bar radial-bar-{{$financial_progress_bay}} radial-bar-lg radial-bar-red mb-5"></div>

                    <div class="progress" style="height: 20px;">
                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" role="progressbar" style="width: {{$financial_progress_borno}}%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">Borno: {{$financial_progress_borno}}%</div>
                    </div>
                    <br>

                    <div class="progress" style="height: 20px;">
                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar" style="width: {{$financial_progress_adm}}%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">Adamawa: {{$financial_progress_adm}}%</div>
                    </div>
                    <br>

                    <div class="progress" style="height: 20px;">
                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" role="progressbar" style="width: {{$financial_progress_yobe}}%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">Yobe: {{$financial_progress_yobe}}%</div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-xl-6 col-md-6">
            <div class="card sale-card" >
                <div class="card-header">
                    <h3>{{ __('Physical Progress')}}</h3>
                </div>
                <div class="card-block text-center">
                    <div data-label="{{$physical_progress_bay}}%" class="radial-bar radial-bar-{{$physical_progress_bay}} radial-bar-lg radial-bar-red mb-5"></div>

                    <div class="progress" style="height: 20px;">
                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" role="progressbar" style="width: {{$physical_progress_borno}}%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">Borno: {{$physical_progress_borno}}%</div>
                    </div>
                    <br>

                    <div class="progress" style="height: 20px;">
                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar" style="width: {{$physical_progress_adm}}%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">Adamawa: {{$physical_progress_adm}}%</div>
                    </div>
                    <br>

                    <div class="progress" style="height: 20px;">
                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" role="progressbar" style="width: {{$physical_progress_yobe}}%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">Yobe: {{$physical_progress_yobe}}%</div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- Charts --}}
    <div id="charts" class="row"></div>

    <script>
        //title = Total Amounts Allocated Per State
        //beneficiary by states charts
        var allocated = @json($allocated);

        var colors = ['#007892', '#e71414', '#000000', '#A10200', '#007D7D', '#0C4289', '#3B0E8E'
            , '#510A8C', '#A40164', '#D00101', '#D05001', '#D08901', '#2BB001', '#19035F', '#005D3A', '#618300'
            , '#8A6E00', '#4E025B', '#0E1012', '#717A83', '#8F0083', '#1E040C', '#F3004A', '#11020D', '#41EAF2'
            , '#8A6EA0', '#4E028B', '#0E101A', '#717A8B', '#8F0081', '#1E043C', '#F3004B', '#110200', '#41EAA2'
            , '#AA6EA0', '#4A028B', '#1E101A', '#7A7A8B', '#7F0081', '#4E043C', '#E3004B', '#A10200', '#D1EAA2'
        ];

        function stateName(allocated) {
            return allocated.state.name;
        }

        function uniqueStates(states) {
            return Array.from(new Set(states));
        }

        function amountAllocated(state) {
            var amnt = 0;
            allocated.forEach(allocate => {
                if (allocate.state.name == state) {
                    amnt += allocate.amount;
                }
            });
            return amnt;
        }

        function drawChart(allocated) {


            var stateNames = uniqueStates(allocated.map(stateName));
            var amountsAllocated = stateNames.map(amountAllocated);

            let ctx = createChartLayout("Total Amounts Allocated Per State").getContext('2d');

            var myChart = new Chart(ctx, {
                type: 'bar'
                , data: {
                    labels: stateNames
                    , datasets: [{
                        label: '# Total Amounts Allocated Per State'
                        , data: amountsAllocated
                        , backgroundColor: colors
                        , borderColor: colors
                        , borderWidth: 1
                    }]
                }
                , options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        }

        drawChart(allocated);

    </script>
    <script>
        //title = Total Amounts Released Per State
        var allocated = @json($released);

        var colors = ['#007892', '#e71414', '#000000', '#A10200', '#007D7D', '#0C4289', '#3B0E8E'
            , '#510A8C', '#A40164', '#D00101', '#D05001', '#D08901', '#2BB001', '#19035F', '#005D3A', '#618300'
            , '#8A6E00', '#4E025B', '#0E1012', '#717A83', '#8F0083', '#1E040C', '#F3004A', '#11020D', '#41EAF2'
            , '#8A6EA0', '#4E028B', '#0E101A', '#717A8B', '#8F0081', '#1E043C', '#F3004B', '#110200', '#41EAA2'
            , '#AA6EA0', '#4A028B', '#1E101A', '#7A7A8B', '#7F0081', '#4E043C', '#E3004B', '#A10200', '#D1EAA2'
        ];

        function stateName(allocated) {
            return allocated.state.name;
        }

        function uniqueStates(states) {
            return Array.from(new Set(states));
        }

        function amountAllocated(state) {
            var amnt = 0;
            allocated.forEach(allocate => {
                if (allocate.state.name == state) {
                    amnt += allocate.amount;
                }
            });
            return amnt;
        }

        function drawChart(allocated) {


            var stateNames = uniqueStates(allocated.map(stateName));
            var amountsAllocated = stateNames.map(amountAllocated);

            let ctx = createChartLayout("Total Amounts Released Per State").getContext('2d');

            var myChart = new Chart(ctx, {
                type: 'bar'
                , data: {
                    labels: stateNames
                    , datasets: [{
                        label: '# Total Amounts Released Per State'
                        , data: amountsAllocated
                        , backgroundColor: colors
                        , borderColor: colors
                        , borderWidth: 1
                    }]
                }
                , options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        }

        drawChart(allocated);

    </script>

    <script>
        //investments by states charts
        var adamawaInvestments = @json($adamawaInvestments);
        var bornoInvestments = @json($bornoInvestments);
        var yobeInvestments = @json($yobeInvestments);
        var investments = @json($investments);
        var colors = ['#007892', '#e71414', '#000000', '#A10200', '#007D7D', '#0C4289', '#3B0E8E'
            , '#510A8C', '#A40164', '#D00101', '#D05001', '#D08901', '#2BB001', '#19035F', '#005D3A', '#618300'
            , '#8A6E00', '#4E025B', '#0E1012', '#717A83', '#8F0083', '#1E040C', '#F3004A', '#11020D', '#41EAF2'
            , '#8A6EA0', '#4E028B', '#0E101A', '#717A8B', '#8F0081', '#1E043C', '#F3004B', '#110200', '#41EAA2'
            , '#AA6EA0', '#4A028B', '#1E101A', '#7A7A8B', '#7F0081', '#4E043C', '#E3004B', '#A10200', '#D1EAA2'
        ];

        function getType(investment) {
            return investment.type;
        }

        function uniqueInvestments(investments) {
            return Array.from(new Set(investments));
        }

        function amountAllocated(investmentType, investments) {
            var amnt = 0;
            investments.forEach(investment => {
                if (investment.type == investmentType) {
                    amnt += investment.amount;
                }
            });
            return amnt;
        }

        function drawChart(allocated) {


            var investmentTypes = uniqueInvestments(investments.map(getType));
            var adamawaAmountsAllocated = investmentTypes.map(function(investmentType) {
                return amountAllocated(investmentType, adamawaInvestments);
            });

            var bornoAmountsAllocated = investmentTypes.map(function(investmentType) {
                return amountAllocated(investmentType, bornoInvestments);
            });

            var yobeAmountsAllocated = investmentTypes.map(function(investmentType) {
                return amountAllocated(investmentType, yobeInvestments);
            });
                //7 datasets
            var ctx = document.getElementById('investments').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar'
                , data: {
                    labels: ['Adamawa', 'Borno', 'Yobe']
                    , datasets: [{
                            labels: adamawaInvestmentTypes
                            , data: adamawaAmountsAllocated
                            , backgroundColor: colors
                            , borderColor: colors
                            , borderWidth: 1
                        },

                        {
                            labels: bornoInvestmentTypes
                            , data: bornoAmountsAllocated
                            , backgroundColor: colors
                            , borderColor: colors
                            , borderWidth: 1
                        },

                        {
                            labels: yobeInvestmentTypes
                            , data: yobeAmountsAllocated
                            , backgroundColor: colors
                            , borderColor: colors
                            , borderWidth: 1
                        }
                    ]
                }
                , options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        }

        drawChart(allocated);

    </script>
    <script>
        /// title = Investments in Infrastructure

        var adamawaInvestments = @json($adamawaInvestments);
        var bornoInvestments = @json($bornoInvestments);
        var yobeInvestments = @json($yobeInvestments);

        var colors = ['#007892', '#e71414', '#000000', '#A10200', '#007D7D', '#0C4289', '#3B0E8E'
            , '#510A8C', '#A40164', '#D00101', '#D05001', '#D08901', '#2BB001', '#19035F', '#005D3A', '#618300'
            , '#8A6E00', '#4E025B', '#0E1012', '#717A83', '#8F0083', '#1E040C', '#F3004A', '#11020D', '#41EAF2'
            , '#8A6EA0', '#4E028B', '#0E101A', '#717A8B', '#8F0081', '#1E043C', '#F3004B', '#110200', '#41EAA2'
            , '#AA6EA0', '#4A028B', '#1E101A', '#7A7A8B', '#7F0081', '#4E043C', '#E3004B', '#A10200', '#D1EAA2'
        ];

        function getType(investment) {
            return investment.type;
        }

        function uniqueInvestments(investments) {
            return Array.from(new Set(investments));
        }

        function amountAllocated(investments) {
            var amnt = 0;
            investments.forEach(investment => {
                if (investment.category == 'Infrastructure') {
                    amnt += investment.amount;
                }
            });
            return amnt;
        }

        function drawChart(allocated) {
            let ctx = createChartLayout("Investments in Infrastructure").getContext('2d');

            var myChart = new Chart(ctx, {
                type: 'bar'
                , data: {
                    labels: ['Adamawa', 'Borno', 'Yobe']
                    , datasets: [{
                        label: "Investments in Infrastructure"
                        , data: [amountAllocated(adamawaInvestments), amountAllocated(bornoInvestments), amountAllocated(yobeInvestments)]
                        , backgroundColor: colors
                        , borderColor: colors
                        , borderWidth: 1
                    }]
                }
                , options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        }

        drawChart(allocated);

    </script>
    <script>
        //title = Investments in Capacity Development
        var adamawaInvestments = @json($adamawaInvestments);
        var bornoInvestments = @json($bornoInvestments);
        var yobeInvestments = @json($yobeInvestments);

        var colors = ['#007892', '#e71414', '#000000', '#A10200', '#007D7D', '#0C4289', '#3B0E8E'
            , '#510A8C', '#A40164', '#D00101', '#D05001', '#D08901', '#2BB001', '#19035F', '#005D3A', '#618300'
            , '#8A6E00', '#4E025B', '#0E1012', '#717A83', '#8F0083', '#1E040C', '#F3004A', '#11020D', '#41EAF2'
            , '#8A6EA0', '#4E028B', '#0E101A', '#717A8B', '#8F0081', '#1E043C', '#F3004B', '#110200', '#41EAA2'
            , '#AA6EA0', '#4A028B', '#1E101A', '#7A7A8B', '#7F0081', '#4E043C', '#E3004B', '#A10200', '#D1EAA2'
        ];

        function getType(investment) {
            return investment.type;
        }

        function uniqueInvestments(investments) {
            return Array.from(new Set(investments));
        }

        function amountAllocated(investments) {
            var amnt = 0;
            investments.forEach(investment => {
                if (investment.category == 'Capacity Development') {
                    amnt += investment.amount;
                }
            });
            return amnt;
        }

        function drawChart(allocated) {
            let ctx = createChartLayout("Investments in Capacity Development").getContext('2d');

            var myChart = new Chart(ctx, {
                type: 'bar'
                , data: {
                    labels: ['Adamawa', 'Borno', 'Yobe']
                    , datasets: [{
                        label: "Investments in Capacity Development"
                        , data: [amountAllocated(adamawaInvestments), amountAllocated(bornoInvestments), amountAllocated(yobeInvestments)]
                        , backgroundColor: colors
                        , borderColor: colors
                        , borderWidth: 1
                    }]
                }
                , options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        }

        drawChart(allocated);

    </script>
    <script>
        //title = Livelyhoods/Transitional Support
        var adamawaInvestments = @json($adamawaInvestments);
        var bornoInvestments = @json($bornoInvestments);
        var yobeInvestments = @json($yobeInvestments);

        var colors = ['#007892', '#e71414', '#000000', '#A10200', '#007D7D', '#0C4289', '#3B0E8E'
            , '#510A8C', '#A40164', '#D00101', '#D05001', '#D08901', '#2BB001', '#19035F', '#005D3A', '#618300'
            , '#8A6E00', '#4E025B', '#0E1012', '#717A83', '#8F0083', '#1E040C', '#F3004A', '#11020D', '#41EAF2'
            , '#8A6EA0', '#4E028B', '#0E101A', '#717A8B', '#8F0081', '#1E043C', '#F3004B', '#110200', '#41EAA2'
            , '#AA6EA0', '#4A028B', '#1E101A', '#7A7A8B', '#7F0081', '#4E043C', '#E3004B', '#A10200', '#D1EAA2'
        ];

        function getType(investment) {
            return investment.type;
        }

        function uniqueInvestments(investments) {
            return Array.from(new Set(investments));
        }

        function amountAllocated(investments) {
            var amnt = 0;
            investments.forEach(investment => {
                if (investment.category == 'Livelyhoods/Transitional Support') {
                    amnt += investment.amount;
                }
            });
            return amnt;
        }

        function drawChart(allocated) {



            let ctx = createChartLayout("Livelyhoods/Transitional Support").getContext('2d');

            var myChart = new Chart(ctx, {
                type: 'bar'
                , data: {
                    labels: ['Adamawa', 'Borno', 'Yobe']
                    , datasets: [{
                        label: "Investments in Livelihoods/Transitional Support"
                        , data: [amountAllocated(adamawaInvestments), amountAllocated(bornoInvestments), amountAllocated(yobeInvestments)]
                        , backgroundColor: colors
                        , borderColor: colors
                        , borderWidth: 1
                    }]
                }
                , options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        }

        drawChart(allocated);

    </script>
    <script>
        //title= projects
        var projects = @json($projects);
        var statuses = ['initiated', 'ongoing', 'completed'];
        var colors = ['#007892', '#e71414', '#000000', '#A10200', '#007D7D', '#0C4289', '#3B0E8E'
            , '#510A8C', '#A40164', '#D00101', '#D05001', '#D08901', '#2BB001', '#19035F', '#005D3A', '#618300'
            , '#8A6E00', '#4E025B', '#0E1012', '#717A83', '#8F0083', '#1E040C', '#F3004A', '#11020D', '#41EAF2'
            , '#8A6EA0', '#4E028B', '#0E101A', '#717A8B', '#8F0081', '#1E043C', '#F3004B', '#110200', '#41EAA2'
            , '#AA6EA0', '#4A028B', '#1E101A', '#7A7A8B', '#7F0081', '#4E043C', '#E3004B', '#A10200', '#D1EAA2'
        ];

        function noOfProjects(status) {
            var i = 0;
            projects.forEach(project => {
                if (project.status == status) {
                    i++;
                }
            })
            return i;
        }


        function drawChart(statuses) {
            var data = statuses.map(noOfProjects);
            let ctx = createChartLayout("Projects").getContext('2d');

            var myChart = new Chart(ctx, {
                type: 'bar'
                , data: {
                    labels: statuses
                    , datasets: [{
                        label: "projects"
                        , data: data
                        , backgroundColor: colors
                        , borderColor: colors
                        , borderWidth: 1
                    }]
                }
                , options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        }

        drawChart(statuses);

    </script>

    {{-- <script>
        //title = male and Female Beneficiaries Per State
        var adamawaBeneficiaries = @json($adamawaBeneficiaries);
        var bornoBeneficiaries = @json($bornoBeneficiaries);
        var yobeBeneficiaries = @json($yobeBeneficiaries);

        var colors = ['#007892', '#e71414', '#000000', '#A10200', '#007D7D', '#0C4289', '#3B0E8E'
            , '#510A8C', '#A40164', '#D00101', '#D05001', '#D08901', '#2BB001', '#19035F', '#005D3A', '#618300'
            , '#8A6E00', '#4E025B', '#0E1012', '#717A83', '#8F0083', '#1E040C', '#F3004A', '#11020D', '#41EAF2'
            , '#8A6EA0', '#4E028B', '#0E101A', '#717A8B', '#8F0081', '#1E043C', '#F3004B', '#110200', '#41EAA2'
            , '#AA6EA0', '#4A028B', '#1E101A', '#7A7A8B', '#7F0081', '#4E043C', '#E3004B', '#A10200', '#D1EAA2'
        ];


        function getBeneficiariesByGender(gender, beneficiaries) {
            var i = 0;
            beneficiaries.forEach(beneficiary => {
                if (beneficiary.gender == gender) {
                    i++;
                }
            })
            return i;
        }

        function drawChart() {

            let ctx = createChartLayout("male and Female Beneficiaries Per State").getContext('2d');

            var myChart = new Chart(ctx, {
                type: 'bar'
                , data: {
                    labels: ['adamawa', 'borno', 'yobe']
                    , datasets: [{
                            label: "male"
                            , data: [getBeneficiariesByGender('male', adamawaBeneficiaries), getBeneficiariesByGender('male', bornoBeneficiaries), getBeneficiariesByGender('male', yobeBeneficiaries)]
                            , backgroundColor: 'blue'
                            , borderColor: 'blue'
                            , borderWidth: 1
                        }
                        , {
                            label: "female"
                            , data: [getBeneficiariesByGender('female', adamawaBeneficiaries), getBeneficiariesByGender('female', bornoBeneficiaries), getBeneficiariesByGender('female', yobeBeneficiaries)]
                            , backgroundColor: 'red'
                            , borderColor: 'red'
                            , borderWidth: 1
                        }
                    , ]
                }
                , options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        }

        drawChart();

    </script> --}}

    <script>
        //title = Adamawa Investments
        var adamawaInvestments = @json($adamawaInvestments);
        var investmentTypes = [
            'Public Buildings'
            , 'Education'
            , 'Health'
            , 'Wash'
            , 'Roads'
        ];
        var colors = ['#007892', '#e71414', '#000000', '#A10200', '#007D7D', '#0C4289', '#3B0E8E'
            , '#510A8C', '#A40164', '#D00101', '#D05001', '#D08901', '#2BB001', '#19035F', '#005D3A', '#618300'
            , '#8A6E00', '#4E025B', '#0E1012', '#717A83', '#8F0083', '#1E040C', '#F3004A', '#11020D', '#41EAF2'
            , '#8A6EA0', '#4E028B', '#0E101A', '#717A8B', '#8F0081', '#1E043C', '#F3004B', '#110200', '#41EAA2'
            , '#AA6EA0', '#4A028B', '#1E101A', '#7A7A8B', '#7F0081', '#4E043C', '#E3004B', '#A10200', '#D1EAA2'
        ];



        function amountAllocated(investmentType) {
            var amnt = 0;
            adamawaInvestments.forEach(investment => {
                if (investment.type == investmentType) {
                    amnt += investment.amount;
                }
            });
            return amnt;
        }

        function drawChart() {

            var adamawaAmountsAllocated = investmentTypes.map(amountAllocated);

            //7 datasets
            let ctx = createChartLayout("Adamawa Investments").getContext('2d');

            var myChart = new Chart(ctx, {
                type: 'doughnut'
                , data: {
                    labels: investmentTypes
                    , datasets: [{
                        labels: 'Adamawa Investments'
                        , data: adamawaAmountsAllocated
                        , backgroundColor: colors
                        , borderColor: colors
                        , borderWidth: 1
                    }]
                }
                , options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        }

        drawChart();

    </script>

    <script>
        //title = Borno Investments
        var bornoInvestments = @json($bornoInvestments);
        var investmentTypes = [
            'Public Buildings'
            , 'Education'
            , 'Health'
            , 'Wash'
            , 'Roads'
        ];
        var colors = ['#007892', '#e71414', '#000000', '#A10200', '#007D7D', '#0C4289', '#3B0E8E'
            , '#510A8C', '#A40164', '#D00101', '#D05001', '#D08901', '#2BB001', '#19035F', '#005D3A', '#618300'
            , '#8A6E00', '#4E025B', '#0E1012', '#717A83', '#8F0083', '#1E040C', '#F3004A', '#11020D', '#41EAF2'
            , '#8A6EA0', '#4E028B', '#0E101A', '#717A8B', '#8F0081', '#1E043C', '#F3004B', '#110200', '#41EAA2'
            , '#AA6EA0', '#4A028B', '#1E101A', '#7A7A8B', '#7F0081', '#4E043C', '#E3004B', '#A10200', '#D1EAA2'
        ];



        function amountAllocated(investmentType) {
            var amnt = 0;
            bornoInvestments.forEach(investment => {
                if (investment.type == investmentType) {
                    amnt += investment.amount;
                }
            });
            return amnt;
        }

        function drawChart() {

            var bornoAmountsAllocated = investmentTypes.map(amountAllocated);

            //7 datasets
            let ctx = createChartLayout("Borno Investments").getContext('2d');

            var myChart = new Chart(ctx, {
                type: 'doughnut'
                , data: {
                    labels: investmentTypes
                    , datasets: [{
                        labels: 'Borno Investments'
                        , data: bornoAmountsAllocated
                        , backgroundColor: colors
                        , borderColor: colors
                        , borderWidth: 1
                    }]
                }
                , options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        }

        drawChart();

    </script>

    <script>
        //title = Yobe Investments
        var yobeInvestments = @json($yobeInvestments);
        var investmentTypes = [
            'Public Buildings'
            , 'Education'
            , 'Health'
            , 'Wash'
            , 'Roads'
        ];
        var colors = ['#007892', '#e71414', '#000000', '#A10200', '#007D7D', '#0C4289', '#3B0E8E'
            , '#510A8C', '#A40164', '#D00101', '#D05001', '#D08901', '#2BB001', '#19035F', '#005D3A', '#618300'
            , '#8A6E00', '#4E025B', '#0E1012', '#717A83', '#8F0083', '#1E040C', '#F3004A', '#11020D', '#41EAF2'
            , '#8A6EA0', '#4E028B', '#0E101A', '#717A8B', '#8F0081', '#1E043C', '#F3004B', '#110200', '#41EAA2'
            , '#AA6EA0', '#4A028B', '#1E101A', '#7A7A8B', '#7F0081', '#4E043C', '#E3004B', '#A10200', '#D1EAA2'
        ];



        function amountAllocated(investmentType) {
            var amnt = 0;
            yobeInvestments.forEach(investment => {
                if (investment.type == investmentType) {
                    amnt += investment.amount;
                }
            });
            return amnt;
        }

        function drawChart() {

            var yobeAmountsAllocated = investmentTypes.map(amountAllocated);

            //7 datasets
            let ctx = createChartLayout("Yobe Investments").getContext('2d');

            var myChart = new Chart(ctx, {
                type: 'doughnut'
                , data: {
                    labels: investmentTypes
                    , datasets: [{
                        labels: 'Yobe Investments'
                        , data: yobeAmountsAllocated
                        , backgroundColor: colors
                        , borderColor: colors
                        , borderWidth: 1
                    }]
                }
                , options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        }

        drawChart();

    </script>

    {{-- <script>
        var adamawaBeneficiaries = @json($adamawaBeneficiaries);
        var bornoBeneficiaries = @json($bornoBeneficiaries);
        var yobeBeneficiaries = @json($yobeBeneficiaries);
        var beneficiaries = @json($beneficiaries);
        console.log(adamawaBeneficiaries);
        console.log('ben gender');

        var colors = ['#007892', '#e71414', '#000000', '#A10200', '#007D7D', '#0C4289', '#3B0E8E'
            , '#510A8C', '#A40164', '#D00101', '#D05001', '#D08901', '#2BB001', '#19035F', '#005D3A', '#618300'
            , '#8A6E00', '#4E025B', '#0E1012', '#717A83', '#8F0083', '#1E040C', '#F3004A', '#11020D', '#41EAF2'
            , '#8A6EA0', '#4E028B', '#0E101A', '#717A8B', '#8F0081', '#1E043C', '#F3004B', '#110200', '#41EAA2'
            , '#AA6EA0', '#4A028B', '#1E101A', '#7A7A8B', '#7F0081', '#4E043C', '#E3004B', '#A10200', '#D1EAA2'
        ];

        function benefitName(beneficiary) {
            return beneficiary.benefit.name
        }


        function getMaleBeneficiaries(beneficiaries, benefit) {
            var i = 0;
            beneficiaries.forEach(beneficiary => {
                if (beneficiary.benefit.name == benefit && beneficiary.gender == 'male') {
                    i++
                }
            });
            return i;
        }

        function getFeMaleBeneficiaries(beneficiaries, benefit) {
            var i = 0;
            beneficiaries.forEach(beneficiary => {
                if (beneficiary.benefit.name == benefit && beneficiary.gender == 'female') {
                    i++
                }
            });
            return i;
        }

        var benefitNames = Array.from(new Set(beneficiaries.map(benefitName)));

        // function drawChart(adamawabeneficiaries, bornoBeneficiaries, yobeBeneficiaries, benefit, id) {
        //     //use the benefit variable as the title(3rd Function Argument)

        //     let ctx = createChartLayout(benefit).getContext('2d');


        //     adaMaleBen = getMaleBeneficiaries(adamawabeneficiaries, benefit);
        //     borMaleBen = getMaleBeneficiaries(bornoBeneficiaries, benefit);
        //     yobeMaleBen = getMaleBeneficiaries(yobeBeneficiaries, benefit);

        //     adaFeMaleBen = getFeMaleBeneficiaries(adamawabeneficiaries, benefit);
        //     borFeMaleBen = getFeMaleBeneficiaries(bornoBeneficiaries, benefit);
        //     yobeFeMaleBen = getFeMaleBeneficiaries(yobeBeneficiaries, benefit);
        //     var myChart = new Chart(ctx, {
        //         type: 'bar'
        //         , data: {
        //             labels: ['Adamawa', 'borno', 'Yobe']
        //             , datasets: [{
        //                     label: 'Male'
        //                     , data: [adaMaleBen, borMaleBen, yobeMaleBen]
        //                     , backgroundColor: 'orange'
        //                     , borderColor: colors
        //                     , borderWidth: 1
        //                 }
        //                 , {
        //                     label: 'Female'
        //                     , data: [adaFeMaleBen, borFeMaleBen, yobeFeMaleBen]
        //                     , backgroundColor: 'blue'
        //                     , borderColor: colors
        //                     , borderWidth: 1
        //                 }
        //             ]
        //         }
        //         , options: {
        //             scales: {
        //                 yAxes: [{
        //                     ticks: {
        //                         beginAtZero: true
        //                     }
        //                 }]
        //             }
        //         }
        //     });
        // }

        benefitNames.forEach(function(benefit, id) {
            drawChart(adamawaBeneficiaries, bornoBeneficiaries, yobeBeneficiaries, benefit, id);
        });

    </script> --}}

    <script>
        var adamawaprojects = @json($adamawaProjects);
        var bornoprojects = @json($bornoProjects);
        var yobeprojects = @json($yobeProjects);
        var projects = @json($projects);


        var types = ['Transport Infrastructure', 'Hand Pump Boreholes', 'Wash Infrastructure', 'Solar Powerd Boreholes', 'Schools', 'Classroom Blocks'];

        var colors = ['#007892', '#e71414', '#000000', '#A10200', '#007D7D', '#0C4289', '#3B0E8E'
            , '#510A8C', '#A40164', '#D00101', '#D05001', '#D08901', '#2BB001', '#19035F', '#005D3A', '#618300'
            , '#8A6E00', '#4E025B', '#0E1012', '#717A83', '#8F0083', '#1E040C', '#F3004A', '#11020D', '#41EAF2'
            , '#8A6EA0', '#4E028B', '#0E101A', '#717A8B', '#8F0081', '#1E043C', '#F3004B', '#110200', '#41EAA2'
            , '#AA6EA0', '#4A028B', '#1E101A', '#7A7A8B', '#7F0081', '#4E043C', '#E3004B', '#A10200', '#D1EAA2'
        ];




        function getNumberOfProjects(projects, type) {
            // console.log(projects);
            var i = 0;
            projects.forEach(project => {
                if (project.type == type) {
                    i += project.number;
                }
            });
            return i;
        }





        function drawChart(adamawaprojects, bornoprojects, yobeprojects, type, id) {
            // use the type variable as the title
            let ctx = createChartLayout(type).getContext('2d');



            adamawaprojects = getNumberOfProjects(adamawaprojects, type);
            bornoprojects = getNumberOfProjects(bornoprojects, type);
            yobeprojects = getNumberOfProjects(yobeprojects, type);

            var myChart = new Chart(ctx, {
                type: 'pie'
                , data: {
                    labels: ['Adamawa Projects', 'borno Projects', 'Yobe Projects']
                    , datasets: [{
                        data: [adamawaprojects, bornoprojects, yobeprojects]
                        , backgroundColor: colors
                        , borderColor: colors
                        , borderWidth: 1
                    }]
                }
                , options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        }

        types.forEach(function(type, id) {
            drawChart(adamawaprojects, bornoprojects, yobeprojects, type, id);
        });

    </script>

    <script>
        //title = Adamawa state Total social cohesion activity participants
        var adamawaSocials = @json($adamawaSocials);
        var bornoSocials = @json($bornoSocials);
        var yobeSocials = @json($yobeSocials);

        var participantTypes = ["Peace groups formed or supported by project", "Peace group participant", 'Social cohesion activity participant', "Psycho social support"];

        var colors = ['#007892', '#e71414', '#000000', '#A10200', '#007D7D', '#0C4289', '#3B0E8E'
            , '#510A8C', '#A40164', '#D00101', '#D05001', '#D08901', '#2BB001', '#19035F', '#005D3A', '#618300'
            , '#8A6E00', '#4E025B', '#0E1012', '#717A83', '#8F0083', '#1E040C', '#F3004A', '#11020D', '#41EAF2'
            , '#8A6EA0', '#4E028B', '#0E101A', '#717A8B', '#8F0081', '#1E043C', '#F3004B', '#110200', '#41EAA2'
            , '#AA6EA0', '#4A028B', '#1E101A', '#7A7A8B', '#7F0081', '#4E043C', '#E3004B', '#A10200', '#D1EAA2'
        ];



        function participants(participantType) {
            var amnt = 0;
            adamawaSocials.forEach(social => {
                if (social.participant_type == participantType) {
                    amnt += social.number;
                }
            });
            return amnt;
        }

        function drawChart() {
            //layout
            let ctx = createChartLayout("Adamawa state Total social cohesion activity participantss").getContext('2d');



            var adamawaValues = participantTypes.map(participants);

            var myChart = new Chart(ctx, {
                type: 'doughnut'
                , data: {
                    labels: participantTypes
                    , datasets: [{
                        labels: 'Adamawa state Total social cohesion activity participants'
                        , data: adamawaValues
                        , backgroundColor: colors
                        , borderColor: colors
                        , borderWidth: 1
                    }]
                }
                , options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        }

        drawChart();

    </script>

    <script>
        // title ='Borno state Total social cohesion activity participants
        var bornoSocials = @json($bornoSocials);


        var participantTypes = ["Peace groups formed or supported by project", "Peace group participant", 'Social cohesion activity participant', "Psycho social support"];

        var colors = ['#007892', '#e71414', '#000000', '#A10200', '#007D7D', '#0C4289', '#3B0E8E'
            , '#510A8C', '#A40164', '#D00101', '#D05001', '#D08901', '#2BB001', '#19035F', '#005D3A', '#618300'
            , '#8A6E00', '#4E025B', '#0E1012', '#717A83', '#8F0083', '#1E040C', '#F3004A', '#11020D', '#41EAF2'
            , '#8A6EA0', '#4E028B', '#0E101A', '#717A8B', '#8F0081', '#1E043C', '#F3004B', '#110200', '#41EAA2'
            , '#AA6EA0', '#4A028B', '#1E101A', '#7A7A8B', '#7F0081', '#4E043C', '#E3004B', '#A10200', '#D1EAA2'
        ];



        function participants(participantType) {
            var amnt = 0;
            bornoSocials.forEach(social => {
                if (social.participant_type == participantType) {
                    amnt += social.number;
                }
            });
            return amnt;
        }

        function drawChart() {
            //layout
            let ctx = createChartLayout("Borno state Total social cohesion activity participants").getContext('2d');
            var bornoValues = participantTypes.map(participants);

            var myChart = new Chart(ctx, {
                type: 'doughnut'
                , data: {
                    labels: participantTypes
                    , datasets: [{
                        labels: 'Borno state Total social cohesion activity participants'
                        , data: bornoValues
                        , backgroundColor: colors
                        , borderColor: colors
                        , borderWidth: 1
                    }]
                }
                , options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        }

        drawChart();

    </script>

    <script>
        //title = 'Yobe state Total social cohesion activity participants
        var yobeSocials = @json($yobeSocials);

        var participantTypes = ["Peace groups formed or supported by project", "Peace group participant", 'Social cohesion activity participant', "Psycho social support"];

        var colors = ['#007892', '#e71414', '#000000', '#A10200', '#007D7D', '#0C4289', '#3B0E8E'
            , '#510A8C', '#A40164', '#D00101', '#D05001', '#D08901', '#2BB001', '#19035F', '#005D3A', '#618300'
            , '#8A6E00', '#4E025B', '#0E1012', '#717A83', '#8F0083', '#1E040C', '#F3004A', '#11020D', '#41EAF2'
            , '#8A6EA0', '#4E028B', '#0E101A', '#717A8B', '#8F0081', '#1E043C', '#F3004B', '#110200', '#41EAA2'
            , '#AA6EA0', '#4A028B', '#1E101A', '#7A7A8B', '#7F0081', '#4E043C', '#E3004B', '#A10200', '#D1EAA2'
        ];



        function participants(participantType) {
            var amnt = 0;
            yobeSocials.forEach(social => {
                if (social.participant_type == participantType) {
                    amnt += social.number;
                }
            });
            return amnt;
        }

        function drawChart() {
            //layout
            let ctx = createChartLayout("Yobe state Total social cohesion activity participants").getContext('2d');

            var yobeValues = participantTypes.map(participants);

            var myChart = new Chart(ctx, {
                type: 'doughnut'
                , data: {
                    labels: participantTypes
                    , datasets: [{
                        labels: 'Yobe state Total social cohesion activity participants'
                        , data: yobeValues
                        , backgroundColor: colors
                        , borderColor: colors
                        , borderWidth: 1
                    }]
                }
                , options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        }

        drawChart();

    </script>

    <script>
        //title = "Peace groups formed or supported by project
        var adamawaSocials = @json($adamawaSocials);
        var bornoSocials = @json($bornoSocials);
        var yobeSocials = @json($yobeSocials);

        var participantTypes = ["Peace groups formed or supported by project", "Peace group participant", 'Social cohesion activity participant', "Psycho social support"];

        var colors = ['#007892', '#e71414', '#000000', '#A10200', '#007D7D', '#0C4289', '#3B0E8E'
            , '#510A8C', '#A40164', '#D00101', '#D05001', '#D08901', '#2BB001', '#19035F', '#005D3A', '#618300'
            , '#8A6E00', '#4E025B', '#0E1012', '#717A83', '#8F0083', '#1E040C', '#F3004A', '#11020D', '#41EAF2'
            , '#8A6EA0', '#4E028B', '#0E101A', '#717A8B', '#8F0081', '#1E043C', '#F3004B', '#110200', '#41EAA2'
            , '#AA6EA0', '#4A028B', '#1E101A', '#7A7A8B', '#7F0081', '#4E043C', '#E3004B', '#A10200', '#D1EAA2'
        ];



        function participants(participantType, socials) {
            var amnt = 0;
            socials.forEach(social => {
                if (social.participant_type == participantType) {
                    amnt += social.number;
                }
            });
            return amnt;
        }

        function drawChart() {
            //layout
            let ctx = createChartLayout("Peace groups formed or supported by project").getContext('2d');

            var myChart = new Chart(ctx, {
                type: 'doughnut'
                , data: {
                    labels: ["Adamawa", "Borno", "Yobe"]
                    , datasets: [{
                        labels: "Peace groups formed or supported by project"
                        , data: [participants("Peace groups formed or supported by project", adamawaSocials), participants("Peace groups formed or supported by project", bornoSocials), participants("Peace groups formed or supported by project", yobeSocials)]
                        , backgroundColor: colors
                        , borderColor: colors
                        , borderWidth: 1
                    }]
                }
                , options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        }

        drawChart();

    </script>
    <script>
        //title = Peace group participant
        var adamawaSocials = @json($adamawaSocials);

        var bornoSocials = @json($bornoSocials);
        var yobeSocials = @json($yobeSocials);

        var participantTypes = ["Peace groups formed or supported by project", "Peace group participant", 'Social cohesion activity participant', "Psycho social support"];

        var colors = ['#007892', '#e71414', '#000000', '#A10200', '#007D7D', '#0C4289', '#3B0E8E'
            , '#510A8C', '#A40164', '#D00101', '#D05001', '#D08901', '#2BB001', '#19035F', '#005D3A', '#618300'
            , '#8A6E00', '#4E025B', '#0E1012', '#717A83', '#8F0083', '#1E040C', '#F3004A', '#11020D', '#41EAF2'
            , '#8A6EA0', '#4E028B', '#0E101A', '#717A8B', '#8F0081', '#1E043C', '#F3004B', '#110200', '#41EAA2'
            , '#AA6EA0', '#4A028B', '#1E101A', '#7A7A8B', '#7F0081', '#4E043C', '#E3004B', '#A10200', '#D1EAA2'
        ];



        function participants(participantType, socials) {
            var amnt = 0;
            // console.log(socials);
            socials.forEach(social => {
                if (social.participant_type == participantType) {
                    amnt += social.number;
                }
            });
            return amnt;
        }

        function drawChart(adamawaSocials, bornoSocials, yobeSocials) {
            //layout
            let ctx = createChartLayout("Peace group participant").getContext('2d');

            var myChart = new Chart(ctx, {
                type: 'doughnut'
                , data: {
                    labels: ["Adamawa", "Borno", "Yobe"]
                    , datasets: [{
                        labels: "Peace group participant"
                        , data: [participants("Peace group participant", adamawaSocials), participants("Peace groups formed or supported by project", bornoSocials), participants("Peace groups formed or supported by project", yobeSocials)]
                        , backgroundColor: colors
                        , borderColor: colors
                        , borderWidth: 1
                    }]
                }
                , options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        }

        drawChart(adamawaSocials, bornoSocials, yobeSocials);

    </script>
    <script>
        // title = feedback

        var adamawaFeedback = @json($adamawaFeedback);
        var bornoFeedback = @json($bornoFeedback);
        var yobeFeedback = @json($yobeFeedback);



        var colors = ['#007892', '#e71414', '#000000', '#A10200', '#007D7D', '#0C4289', '#3B0E8E'
            , '#510A8C', '#A40164', '#D00101', '#D05001', '#D08901', '#2BB001', '#19035F', '#005D3A', '#618300'
            , '#8A6E00', '#4E025B', '#0E1012', '#717A83', '#8F0083', '#1E040C', '#F3004A', '#11020D', '#41EAF2'
            , '#8A6EA0', '#4E028B', '#0E101A', '#717A8B', '#8F0081', '#1E043C', '#F3004B', '#110200', '#41EAA2'
            , '#AA6EA0', '#4A028B', '#1E101A', '#7A7A8B', '#7F0081', '#4E043C', '#E3004B', '#A10200', '#D1EAA2'
        ];

        function feedbackPerState(Feedbacks) {
            var i = 0;
            Feedbacks.forEach(feedback => {
                i += feedback.number;
            })
            return i;
        }



        function drawChart(adamawaFeedback, bornoFeedback, yobeFeedback) {
            //layout5
            let ctx = createChartLayout("Feedback").getContext('2d');





            var myChart = new Chart(ctx, {
                type: 'doughnut'
                , data: {
                    labels: ["Adamawa", "Borno", "Yobe"]
                    , datasets: [{
                        label: ""
                        , data: [feedbackPerState(adamawaFeedback), feedbackPerState(bornoFeedback), feedbackPerState(yobeFeedback)]
                        , backgroundColor: colors
                        , borderColor: colors
                        , borderWidth: 1
                    }]
                }
                , options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        }

        drawChart(adamawaFeedback, bornoFeedback, yobeFeedback);

    </script>
    <script>
        //title = communication

        var adamawaCommunication = @json($adamawaCommunication);
        var bornoCommunication = @json($bornoCommunication);
        var yobeCommunication = @json($yobeCommunication);



        var colors = ['#007892', '#e71414', '#000000', '#A10200', '#007D7D', '#0C4289', '#3B0E8E'
            , '#510A8C', '#A40164', '#D00101', '#D05001', '#D08901', '#2BB001', '#19035F', '#005D3A', '#618300'
            , '#8A6E00', '#4E025B', '#0E1012', '#717A83', '#8F0083', '#1E040C', '#F3004A', '#11020D', '#41EAF2'
            , '#8A6EA0', '#4E028B', '#0E101A', '#717A8B', '#8F0081', '#1E043C', '#F3004B', '#110200', '#41EAA2'
            , '#AA6EA0', '#4A028B', '#1E101A', '#7A7A8B', '#7F0081', '#4E043C', '#E3004B', '#A10200', '#D1EAA2'
        ];

        function communicationPerState(Feedbacks) {
            var i = 0;
            Feedbacks.forEach(feedback => {
                i += feedback.number;
            })
            return i;
        }



        function drawChart(adamawaCommunication, bornoCommunication, yobeCommunication) {
            //layout5
            let ctx = createChartLayout("Communication").getContext('2d');


            var myChart = new Chart(ctx, {
                type: 'doughnut'
                , data: {
                    labels: ["Adamawa", "Borno", "Yobe"]
                    , datasets: [{
                        label: "Communication"
                        , data: [communicationPerState(adamawaCommunication), communicationPerState(bornoFeedback), communicationPerState(yobeFeedback)]
                        , backgroundColor: colors
                        , borderColor: colors
                        , borderWidth: 1
                    }]
                }
                , options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        }

        drawChart(adamawaCommunication, bornoCommunication, yobeCommunication);

    </script>

    <script>
        //title = Infrastructure Repair

        var adamawaTransport = @json($adamawaTransport);
        var bornoTransport = @json($bornoTransport);
        var yobeTransport = @json($yobeTransport);


        var colors = ['#007892', '#e71414', '#000000', '#A10200', '#007D7D', '#0C4289', '#3B0E8E'];

        var types = ['Bridge', 'Road'];

        function typePerState(stateTransport, type) {
            var i = 0;
            stateTransport.forEach(transport => {
                if (transport.type == type) {
                    i += transport.number;
                }

            })
            return i;
        }



        function drawChart(adamawaTransport, bornoTransport, yobeTransport) {

            let ctx = createChartLayout("Infrastructure Repair").getContext('2d');

            var myChart = new Chart(ctx, {
                type: 'bar'
                , data: {
                    labels: ["Road Network Restored", "Bridges Restored"]
                    , datasets: [{
                            label: "Adamawa"
                            , data: [typePerState(adamawaTransport, "Road"), typePerState(adamawaTransport, "Bridge")]
                            , backgroundColor: 'green'
                            , borderColor: colors
                            , borderWidth: 1
                        }
                        , {
                            label: "Borno"
                            , data: [typePerState(bornoTransport, "Road"), typePerState(bornoTransport, "Bridge")]
                            , backgroundColor: 'purple'
                            , borderColor: colors
                            , borderWidth: 1
                        }
                        , {
                            label: "Yobe"
                            , data: [typePerState(yobeTransport, "Road"), typePerState(yobeTransport, "Bridge")]
                            , backgroundColor: 'red'
                            , borderColor: colors
                            , borderWidth: 1
                        }
                    ]
                }
                , options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        }

        drawChart(adamawaTransport, bornoTransport, yobeTransport);

    </script>

</div>
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
<script src="{{ asset('js/widget-chart.js') }}"></script>

<script src="{{ asset('js/widget-statistic.js') }}"></script>
<script src="{{ asset('js/widget-data.js') }}"></script>
<script src="{{ asset('js/dashboard-charts.js') }}"></script>



@endpush
@endsection
