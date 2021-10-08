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
        {{-- <div class="container">

		</div> --}}
        <div class="row">
             <div class="col-md-12">
                <div class="card table-card">
                    <div class="card-header">
                        <h3>{{ __('Edit Indicator')}}</h3>
                        <div class="card-header-right">
                            <ul class="list-unstyled card-option">
                                <li><i class="ik ik-chevron-left action-toggle"></i></li>
                                <li><i class="ik ik-minus minimize-card"></i></li>
                                <li><i class="ik ik-x close-card"></i></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-block" style="padding-left: 10px;">
                        <form class="forms-sample" method="POST" action="/indicator/update">
                            @csrf
                            <input type="hidden" name="id" value="{{$indicator->id}}">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">{{ __('Name')}}</label>
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$indicator->name}}" placeholder="Indicator Name" required>
                                    <div class="help-block with-errors"></div>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="target">{{ __('Target')}}</label>
                                    <input id="target" type="text" class="form-control @error('target') is-invalid @enderror" name="target" value="{{$indicator->target}}" placeholder="Enter Target" required>
                                    <div class="help-block with-errors"></div>
                                    @error('target')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="upper_limit">{{ __('Upper Limit')}}</label>
                                    <input id="upper_limit" type="number" class="form-control @error('upper_limit') is-invalid @enderror" name="upper_limit" value="{{$indicator->upper_limit}}" placeholder="Enter upper limit" required>
                                    <div class="help-block with-errors"></div>
                                    @error('upper_limit')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="text">{{ __('Borno')}}</label>
                                    <input id="borno" type="number" class="form-control @error('borno') is-invalid @enderror" name="borno" value="{{$indicator->borno}}" placeholder="Numbers for Borno state" required>
                                    <div class="help-block with-errors"></div>
                                    @error('borno')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="text">{{ __('Adamawa')}}</label>
                                    <input id="adamawa" type="number" class="form-control @error('adamawa') is-invalid @enderror" name="adamawa" value="{{$indicator->adamawa}}" placeholder="Numbers for Adamawa state" required>
                                    <div class="help-block with-errors"></div>
                                    @error('adamawa')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="text">{{ __('Yobe')}}</label>
                                    <input id="yobe" type="number" class="form-control @error('yobe') is-invalid @enderror" name="yobe" value="{{$indicator->yobe}}" placeholder="Numbers for Yobe" required>
                                    <div class="help-block with-errors"></div>
                                    @error('yobe')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="comments">{{ __('Comment')}}</label>
                                    <input id="comments" type="text" class="form-control @error('comments') is-invalid @enderror" name="comments" value="{{$indicator->comments}}" placeholder="Make comment" required>
                                    <div class="help-block with-errors"></div>
                                    @error('comments')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                </div>
                            </div>

                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">{{ __('Submit')}}</button>
                                    <a href="{{url('project/list')}}"  class="btn btn-danger">{{ __('Back')}}</a>
                                </div>
                            </div>

                            </div>
                        </form>
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
