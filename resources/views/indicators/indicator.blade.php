@extends('layouts.main') 
@section('title', 'Indicator')
@section('content')
<div class="content-wrapper">
	<section class="content">
		<div class="panel panel-default">
			<!-- Default panel contents -->
			<div class="panel-heading">
				<div class="page-header">
					<h4>{{$name}}</h4>
				</div>

				<div class="text-right">
					<button onclick="window.print()" class="btn btn-primary" ><i class="fa fa-print"></i> Print page</button>
				</div>
			</div>
			<div class="panel-body">
				<!-- Table -->
				<div class="table-responsive table-stiped">
						<table class="table table-hover">
							<thead>
								<tr>
									<th><h3>State</h3></th>
									<th><h3>Females</h3></th>
									<th><h3>Males</h3></th>
									<th><h3>Total</h3></th>
									<th><h5>Other figures/values</h5></th>
								</tr>
							</thead>
							<tbody>
                                @forelse($indicator as $detail)
								<tr>
								  <td>
                                    @php 
                                       $state = App\State::find($detail->state_id);
                                    @endphp
                                    {{ $state->name}}

                                  </td>
								  <td>{{$detail->female}}</td>
								  <td>{{$detail->male}}</td>
								  <td>
									  @php
									  	$total = $detail->female+$detail->male + $detail->other;
									  @endphp
									  {{$total}}	
								  </td>
                                  <td>{{$detail->other}}</td>
                                  @empty
                                  There are no indicators available at this moment
                                @endforelse							
                            </tbody>
					    </table>	
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