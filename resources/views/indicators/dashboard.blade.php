@extends('layouts.main')
@section('title', 'Dashboard')
@section('content')

    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-file-text bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('Dashboard')}}</h5>
                            <span>{{ __('General information about indicators')}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{route('dashboard')}}"><i class="ik ik-home"></i></a>
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
        <div class="container">

		</div>
        <div class="row">
            {{-- <div class="col-md-12">

                <div class="separator mb-20"></div>
            </div> --}}


             <!-- Customer overview start -->
             <div class="col-md-12">
                <div class="card table-card">
                    <div class="card-header">
                        <h3>{{ __('Indicator Tracker')}}</h3>
                        <div class="card-header-right">
                            <ul class="list-unstyled card-option">
                                <li><i class="ik ik-chevron-left action-toggle"></i></li>
                                <li><i class="ik ik-minus minimize-card"></i></li>
                                <li><i class="ik ik-x close-card"></i></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-block" style="padding-left: 10px;">
                        <div class="table-responsive">
                            <br>
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModalCenter">{{ __('Add New')}} <i class="fa fa-plus"></i></button><br><br>
                            <table id="data_table" class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>{{ __('S/N')}}</th>
                                        <th>{{ __('Indicator Name')}}</th>
                                        <th>{{ __('Target')}}</th>
                                        <th>{{ __('Upper Limit')}}</th>
                                        <th>{{ __('Borno')}}</th>
                                        <th>{{ __('Adamawa')}}</th>
                                        <th>{{ __('Yobe')}}</th>
                                        <th>{{ __('BAY')}}</th>
                                        <th>{{ __('Difference')}}</th>
                                        <th>{{ __('% Difference')}}</th>
                                        <th>{{ __('Comments')}}</th>
                                        <th>{{ __('Action')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $sn = 1; ?>
                                    @foreach ($indicators as $indicator)
                                    <?php
                                        $bay = $indicator->borno+$indicator->adamawa+$indicator->yobe;
                                    ?>
                                    <tr>
                                        <td>{{$sn}}</td>
                                        <td>{{$indicator->name}}</td>
                                        <td>{{$indicator->target}}</td>
                                        <td>{{number_format($indicator->upper_limit)}}</td>
                                        <td>{{number_format($indicator->borno)}}</td>
                                        <td>{{number_format($indicator->adamawa)}}</td>
                                        <td>{{number_format($indicator->yobe)}}</td>
                                        <td><?=number_format($bay); ?></td>
                                        <td><?=number_format($indicator->upper_limit - $bay); ?></td>
                                        <td><?=number_format($bay/$indicator->upper_limit); ?>%</td>
                                        <td>{{$indicator->comments}}</td>
                                        <td>
                                            <a href="/indicator/edit/{{$indicator->id}}">
                                                <i class="ik ik-edit-2 f-16 mr-15 text-green"></i>
                                            </a>
                                            {{-- <a href="/project/delete/{{$indicator->id}}"><i class="ik ik-trash-2 f-16 text-red"></i></a> --}}
                                        </td>
                                        {{-- <td><label class="badge badge-danger">Open</label></td> --}}
                                    </tr>

                                    <?php $sn++; ?>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Customer overview end -->
        </div>
    </div>

    <!-- push external js -->
    @push('script')

        <script src="{{ asset('plugins/sweetalert/dist/sweetalert.min.js') }}"></script>
        <script src="{{ asset('plugins/summernote/dist/summernote-bs4.min.js') }}"></script>
        <script src="{{ asset('js/layouts.js') }}"></script>
        <script src="{{ asset('plugins/DataTables/datatables.min.js') }}"></script>
        <script src="{{ asset('js/datatables.js') }}"></script>
    @endpush
@endsection


<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterLabel">{{ __('Modal title')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">

                <form class="forms-sample" method="POST" action="/indicator/store" enctype="multipart/form-data">
                    @csrf

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="name">{{ __('Name')}}</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="" placeholder="Indicator Name" required>
                            <div class="help-block with-errors"></div>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="target">{{ __('Target')}}</label>
                            <input id="target" type="text" class="form-control @error('target') is-invalid @enderror" name="target" value="" placeholder="Enter Target" required>
                            <div class="help-block with-errors"></div>
                            @error('target')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="upper_limit">{{ __('Upper Limit')}}</label>
                            <input id="upper_limit" type="number" class="form-control @error('upper_limit') is-invalid @enderror" name="upper_limit" value="" placeholder="Enter upper limit" required>
                            <div class="help-block with-errors"></div>
                            @error('upper_limit')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="text">{{ __('Borno')}}</label>
                            <input id="borno" type="number" class="form-control @error('borno') is-invalid @enderror" name="borno" value="" placeholder="Numbers for Borno state" required>
                            <div class="help-block with-errors"></div>
                            @error('borno')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="text">{{ __('Adamawa')}}</label>
                            <input id="adamawa" type="number" class="form-control @error('adamawa') is-invalid @enderror" name="adamawa" value="" placeholder="Numbers for Adamawa state" required>
                            <div class="help-block with-errors"></div>
                            @error('adamawa')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="text">{{ __('Yobe')}}</label>
                            <input id="yobe" type="number" class="form-control @error('yobe') is-invalid @enderror" name="yobe" value="" placeholder="Numbers for Yobe" required>
                            <div class="help-block with-errors"></div>
                            @error('yobe')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>


                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="comments">{{ __('Comment')}}</label>
                            <input id="comments" type="text" class="form-control @error('comments') is-invalid @enderror" name="comments" value="" placeholder="Make comment" required>
                            <div class="help-block with-errors"></div>
                            @error('comments')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                        </div>
                    </div>

                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">{{ __('Submit')}}</button>
                            <a href="{{url('project/list')}}"  class="btn btn-danger">{{ __('Back')}}</a>
                        </div>
                    </div>

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close')}}</button>
                {{-- <button type="button" class="btn btn-primary">{{ __('Save changes')}}</button> --}}
            </div>
        </div>
    </div>
</div>
