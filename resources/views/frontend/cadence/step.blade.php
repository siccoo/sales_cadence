@extends('frontend.layout.app')


@section('content')
<div class="container">
@if(Session::has('error'))
    <div class="alert alert-danger">
  {{Session::get('error')}}
    </div>
    @endif
<div class="row m-auto pt-3">
<form action="{{route('saveCadence', $cadence->id)}}" method="post">  
@csrf 
<?php $i = 1;?>
<?php $templates = App\EmailTemplate::whereUser_id(Sentinel::getUser()->id)->get();?>
@forelse($emailCadence as $email)
<div class="card">
<div class="card-body">
    <table class="table table-bordered">
<thead><tr>
    <th>S/N</th>
    <th>Cadence Type</th>
    <th>Template</th>
    <th>Date to Schedule</th>
</tr></thead>

<tbody>

<tr>
    <td>{{$i++}}</td>
    <td>Email Cadence</td>
    <td><select name="{{$email->temp}}" class="form-control">
        @forelse($templates as $template)
        <option value="{{$template->id}}">{{$template->name}}</option>
        @empty
        Please create a template first
        @endforelse
    </select></td>
    <td><input type="datetime-local" name="date[{{$email->id}}]" required></td>
    
    
</tr>
</tbody>

    


</table>
</div>
</div>
@empty

@endforelse
@if(count($emailCadence) > 0 || count($smsCadence) > 0)

<div class="user-data m-b-30">
                                    <h3 class="title-3 m-b-30">
                                        <i class="zmdi zmdi-account-calendar"></i>My Leads</h3>
										{{-- <div class="filters m-b-45">
                                        <div class="rs-select2--dark rs-select2--md m-r-10 rs-select2--border">
                                            <select class="js-select2 select2-hidden-accessible" name="property" tabindex="-1" aria-hidden="true">
                                                <option selected="selected">All Properties</option>
                                                <option value="">Products</option>
                                                <option value="">Services</option>
                                            </select><span class="select2 select2-container select2-container--default" dir="ltr" style="width: 127px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-property-ld-container"><span class="select2-selection__rendered" id="select2-property-ld-container" title="All Properties">All Properties</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                        <div class="rs-select2--dark rs-select2--sm rs-select2--border">
                                            <select class="js-select2 au-select-dark select2-hidden-accessible" name="time" tabindex="-1" aria-hidden="true">
                                                <option selected="selected">All Time</option>
                                                <option value="">By Month</option>
                                                <option value="">By Day</option>
                                            </select><span class="select2 select2-container select2-container--default" dir="ltr" style="width: 98px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-time-sl-container"><span class="select2-selection__rendered" id="select2-time-sl-container" title="All Time">All Time</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                                            <div class="dropDownSelect2"></div>
                                        </div>
										</div> --}}
                                    <div class="table-responsive table-data">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <td>
													{{-- <label class="au-checkbox">
                                                            <input type="checkbox">
                                                            <span class="au-checkmark"></span>
													</label> --}}
                                                    </td>
                                                    <td>Lead Name</td>
                                                    <td>Email</td>
                                                    <td>Phone</td>
                                                    <td></td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @forelse($leads as $lead)
                                                <tr>
                                                    <td>
                                                        <input type="checkbox" value="1" name="leads[{{$lead->id}}]"/>
                                                    </td>
                                                    <td>
                                                        <div class="table-data__info">
                                                            <h6>{{$lead->first_name}} {{$lead->last_name}}</h6>
                                                            
                                                        </div>
                                                    </td>
                                                    <td>
                                                       <span>
                                                                <a href="#">{{$lead->email}}</a>
                                                            </span> 
                                                    </td>
                                                    <td>
                                                       <span>
                                                                <a href="#">{{$lead->email}}</a>
                                                            </span>
                                                    </td>
                                                    <td>
                                                        <span class="more">
                                                           
                                                        </span>
                                                    </td>
                                                </tr>
                                                @empty
                                                You have not added any lead
                                                @endforelse
												
												   
												
                                               
                                             
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="user-data__footer">
                                        <button class="au-btn au-btn-load">Execute Cadence</button>
                                    </div> 
                                </div>
                               
@endif
</form>
</div>
</div>

<div class="row mt-5">
<div class="col-md-10">
                                <div class="card">
                                    <div class="card-header">
                                        <!-- <strong class="card-title mb-3">Add Step</strong> -->
                                    </div>
                                    <div class="card-body">
                                  
                                    <button class="btn btn-success" data-toggle="modal" data-target="#staticModal">Add Step</button>
             
                                    </div>
                                </div>
                            </div>
</div>
<div class="modal fade" id="staticModal" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" aria-hidden="true"
			 data-backdrop="static">
				<div class="modal-dialog modal-sm" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="staticModalLabel">Pick A Step</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
                        <div class="row">
                            <div class="col-md-4"> 
                                <form action="{{route('email.step', $cadence->id)}}" method="post"> 
                                    @csrf
                            <button type="submit"><img src="{{asset('assets/images/mail.png')}}"></button>
</form>
</div>
<div class="col-md-4"> 
    <form>
                            <button id="close-image"><img src="{{asset('assets/images/sms.png')}}"></button>
</form>
                            </div>
                            <div class="col-md-4"> 
    <form>
                            <button id="close-image"><img src="{{asset('assets/images/call.png')}}"></button>
</form>
                            </div>


                        </div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <!-- <button type="button" class="btn btn-primary">Confirm</button> -->
                            
						</div>
					</div>
				</div>
			</div>
</div>


@stop

@section('script')

@stop