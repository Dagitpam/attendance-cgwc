
    	<div class="row">
    		<!-- page statustic chart start -->
            <div class="col-xl-3 col-md-6">
                <a href="beneficiary/list">
                    <div class="card card-green text-white">
                        <div class="card-block">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h5 class="mb-0">

                                        @php
                                            $beneficiary = App\User::count();
                                            // $c2beneficiary = App\C2beneficiary::sum('beneficiaries');
                                        @endphp
                                        {{ number_format($beneficiary) }}

                                


                                    <p class="mb-0">{{ __('Total Users')}}</p>
                                </div>
                                <div class="col-4 text-right">
                                    <i class="ik ik-users f-30"></i>
                                </div>
                            </div>
                            <div id="Widget-line-chart3" class="chart-line chart-shadow"></div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-3 col-md-6">
                <a href="project/dashboard">

                     <div class="card card-blue text-white">
                        <div class="card-block">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h5 class="mb-0">

                                        @php
                                           $projects = App\Session::all()->count();
                                        @endphp
                                        {{ $projects}}


                                                                           </h5>
                                    <p class="mb-0">{{ __('Total Sessions')}}</p>
                                </div>
                                <div class="col-4 text-right">
                                    <i class="ik ik-book-open f-30"></i>
                                </div>
                            </div>
                            <div id="Widget-line-chart1"class="chart-line chart-shadow"></div>
                        </div>
                    </div>

                </a>

            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card card-red text-white">
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h5 class="mb-0">

                               {{-- @php
                               $amount_disbursed = App\Project::all()->sum('amount_disbursed');
                               @endphp --}}
                               {{-- ${{number_format($amount_disbursed)}}
                               @endrole --}}

                                </h5>
                                <p class="mb-0">{{ __('Attendance')}}</p>
                            </div>
                            <div class="col-4 text-right">
                                <i class="f-30">$</i>
                            </div>
                        </div>
                        <div id="Widget-line-chart4" class="chart-line chart-shadow" ></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card card-yellow text-white">
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h5 class="mb-0">
                             444

                                </h5>
                                <p class="mb-0">{{ __('Attendance')}}</p>
                            </div>
                            <div class="col-4 text-right">
                                <i class="ik ik-credit-card f-30"></i>
                            </div>
                        </div>
                        <div id="Widget-line-chart2" class="chart-line chart-shadow" ></div>
                    </div>
                </div>
            </div>
            <!-- page statustic chart end -->

