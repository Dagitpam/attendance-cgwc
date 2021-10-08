<div class="modal fade apps-modal" id="appsModal" tabindex="-1" role="dialog" aria-labelledby="appsModalLabel" aria-hidden="true" data-backdrop="false">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="ik ik-x-circle"></i></button>
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="page-header">
                <div class="row align-items-end">
                    <div class="col-lg-8">
                        <div class="page-header-title">
                            <div class="d-inline">
                                <h5 style="padding:15px 15px 15px 15px;">{{ __('Filter Beneficiaries')}}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <form class="forms-sample" method="POST" action="/beneficiary/export">
                    @csrf
                    <div class="row">

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="state_id">{{ __('State')}}<span class="text-red">*</span></label>
                                <select id="state-dropdown" name="state_id" class="form-control @error('state') is-invalid @enderror">
                                    <option value="">State</option>
                                    @forelse($states as $type)
                                    <option value="{{$type->id}}">{{$type->name}}</option>
                                    @empty
                                    There are no States available at this moment
                                    @endforelse
                                </select>
                                <div class="help-block with-errors"></div>
                                @error('state_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="lga_id">{{ __('LGA')}}<span class="text-red">*</span></label>
                                <select id="lga-dropdown" name="lga_id" class="form-control @error('lga_id') is-invalid @enderror">
                                   
                                </select>
                                <div class="help-block with-errors"></div>
                                @error('lga_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="gender">{{ __('Gender')}}<span class="text-red">*</span></label>
                                <select id="gender" name="gender" class="form-control @error('gender') is-invalid @enderror" required>
                                    <option value="">select</option>
                                    <option value="2">MALE</option>
                                    <option value="1">FEMALE</option>
                                </select>
                                <div class="help-block with-errors"></div>
                                @error('gender')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="benefit_id">{{ __('Benefit')}}<span class="text-red">*</span></label>
                                <select id="benefit_id" name="benefit_id" class="form-control @error('benefit_id') is-invalid @enderror">
                                    <option value="">Benefits</option>
                                    @forelse($benefits as $benefit)
                                    <option value="{{$benefit->id}}">{{$benefit->name}}</option>
                                    @empty
                                    There are no benefits available at the moment
                                    @endforelse
                                </select>
                                <div class="help-block with-errors"></div>
                                @error('benefit_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="age">{{ __('Age From')}}<span class="text-red">*</span></label>
                                {{-- <input id="age" type="text" class="form-control @error('age') is-invalid @enderror" name="age" value="" placeholder="Enter new beneficiary's age" required> --}}
                                <select id="age" name="age_from" class="form-control" required>
                                    <option value="">select</option>
                                    @for ($a = 1; $a <= 110; $a++) <option value="{{$a}}">{{$a}}</option>
                                        @endfor
                                </select>
                                <div class="help-block with-errors"></div>
                                @error('age')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="age">{{ __('Age To')}}<span class="text-red">*</span></label>
                                {{-- <input id="age" type="text" class="form-control @error('age') is-invalid @enderror" name="age" value="" placeholder="Enter new beneficiary's age" required> --}}
                                <select id="age" name="age_to" class="form-control" required>
                                    <option value="">select</option>
                                    @for ($a = 1; $a <= 110; $a++) <option value="{{$a}}">{{$a}}</option>
                                        @endfor
                                </select>
                                <div class="help-block with-errors"></div>
                                @error('age')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="status_id">{{ __('Status')}}<span class="text-red">*</span></label>
                                <select id="status_id" name="status_id" class="form-control @error('status_id') is-invalid @enderror">
                                    <option value="">Status</option>
                                    @forelse($statuses as $status)
                                    <option value="{{$status->id}}">{{$status->name}}</option>
                                    @empty
                                        There are no statuses available at the moment
                                    @endforelse
                                </select>
                                <div class="help-block with-errors"></div>
                                @error('status_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">{{ __('Export')}}</button>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
