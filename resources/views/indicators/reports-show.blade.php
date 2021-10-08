@extends('layouts.main') 
@section('title', 'Taskboard')
@section('content')
      <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <section class="content">

        <div class="col-md-10">

            <div class="panel panel-primary">

                <div class="page-header">
                <h1><span class="text-primary">Report by | </span><span>{{$report->reported_by}}.</span></h1>
                </div>
                <div class="panel-heading">
                        <h1 class="panel-title">
                            @php 
                                $state = App\State::find($report->state_id);
                            @endphp
                            {{ $state->name}}
                        </h1>
                </div>
                <div class="panel-body">
                <img src="{{asset('images/'.$report->image)}}" class="img-responsive img-square" height="100" width="200" alt="Image"><br>               
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-bold">Community</td>
                                    <td>{{$report->community}}</td>
                                </tr>

                                <tr>
                                    <td class="text-bold">Activity</td>
                                    <td>{{$report->activity}}</td>
                                </tr>

                                <tr>
                                    <td class="text-bold">Component</td>
                                    <td>{{$report->component}}</td>
                                </tr>

                                <tr>
                                    <td class="text-bold">Date</td>
                                    <td>{{$report->created_at}}</td>
                                </tr>

                                <tr>
                                    <td class="text-bold">Indicator</td>
                                    <td>{{$report->indicator}}</td>
                                </tr>

                                <tr>
                                    <td class="text-bold">Target</td>
                                    <td>{{$report->target}}</td>
                                </tr>

                                <tr>
                                    <td class="text-bold">Brief</td>
                                    <td> {{$report->description}}</tr>

                                <tr>
                                    <td class="text-bold">Results</td>
                                    <td>{{$report->results}}</tr>

                                <tr>
                                    <td class="text-bold">Challenges</td>
                                    <td>{{$report->challenge}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="container">
                            <a href="/report/list" class="btn btn-primary btn-sm"><i class="fa fa-list"></i> Back to list</a>
                            <button type="submit" class="btn btn-success btn-sm" onClick="window.print()"><i class="fa fa-fw fa-print"></i> Print</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>
<!-- /.content-wrapper -->

               
    
    <!-- push external js -->
@push('script')
    <script src="{{ asset('plugins/nestable/jquery.nestable.js') }}"></script>
    <script src="{{ asset('js/taskboard.js') }}"></script>
@endpush
@endsection