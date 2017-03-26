@extends('layouts.master')
@section('title')
| Create New Consult
@stop
@section('pageheading')
Create New Consult		
@stop
@section('subpageheading')
Add Consultation for Patient Visit
@stop
@section('stylesheets')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
@stop
@section('content')
<style>
	#report-images{
		width: 10px;
		height: 10px;
		border: 1px solid black;
		margin-bottom: 2px;
	}
</style>

<div class="row">
	<div class="col-md-12">
		<!-- Widget: user widget style 1 -->
		<div class="box box-widget widget-user-2">
			<!-- Add the bg color to the header using any of the bg-* classes -->
			<div class="widget-user-header bg-primary">
				<div class="widget-user-image">
					<img class="img-circle" src="/avatar/docs/default.jpg" alt="User Avatar">
				</div>
				<!-- /.widget-user-image -->
				<h3 class="widget-user-username">{{$patient->name}}</h3>
				<h5 class="widget-user-desc"><span class="badge bg-gray">Created On: {{$patient->created_at->format('D, d F Y')}}</span> | <span class="badge bg-gray">Created By: DR. {{$user->name}}</span> | @if ($patient->dob != "1900-01-01 00:00:00")
					<span class="badge bg-gray">Patient Age: {{-- {{$patient->dob->diffInYears()}} --}} {{$patient->dob->diff(Carbon::now())->format('%y Years, %m Months and %d Days')}}</span>
					@else
					<span class="badge bg-gray">Patient Age: Date of Birth Not Provided</span>
					@endif </h5>

				</div>
			</div>
			<!-- /.widget-user -->
			<h2 class="page-header"><small class="text-red">Known Allergies : {{$patient->allergies}}</small></h2>
		</div>
	</div>
	{{-- .row --}}
	@if (count($errors)>0)
	<div class="row">
		<div class="col-md-12">
			<div class="alert alert-danger">
				<b>Errors</b><br>
				<ul>
					@foreach ($errors->all() as $error)
					<li>
						{{$error}}
					</li>
					@endforeach
				</ul>
			</div>
		</div>
	</div>
	@endif
	@if (count($patient->visits) != 0)
	<div class="row">
		<div class="col-md-12">
			<div class="box box-solid box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">New Consultation</h3>
					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
						</button>
					</div>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<form action="{{route('visits.storelocal')}}" method="POST">
						{{csrf_field()}}
						<input type="hidden" name="patient_id" value="{{$patient->id}}">
						<div class="row">
							<div class="col-md-6 col-xs-12">
								<div class="form-group {{ $errors->has('chiefcomplaints')?'has-error':''}}">
									<label class="control-label" for="chiefcomplaints">Chief Complaints</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>
										<textarea  autofocus=""  name="chiefcomplaints" id="chiefcomplaints" class="form-control" cols="30" rows="3" style="resize: none;">{{old('chiefcomplaints')}}</textarea>
									</div>
									<span class="help-block">{{$errors->first('chiefcomplaints')}}</span>
								</div>
							</div>
							<div class="col-md-6 col-xs-12">
								<div class="form-group {{ $errors->has('examinationfindings')?'has-error':''}}">
									<label class="control-label" for="examinationfindings">Examination Findings</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>
										<textarea   name="examinationfindings" id="examinationfindings" class="form-control" cols="30" rows="3" style="resize: none;">{{old('examinationfindings')}}</textarea>
									</div>
									<span class="help-block">{{$errors->first('examinationfindings')}}</span>
								</div>
							</div>
						</div>
						<!-- /.row -->
						<div class="row">
							<div class="col-md-6 col-xs-12">
								<div class="form-group {{ $errors->has('patienthistory')?'has-error':''}}">
									<label class="control-label" for="patienthistory">History</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>
										<textarea   name="patienthistory" id="patienthistory" class="form-control" cols="30" rows="3" style="resize: none;">{{old('patienthistory')}}</textarea>
									</div>
									<span class="help-block">{{$errors->first('patienthistory')}}</span>
								</div>
							</div>
							<div class="col-md-6 col-xs-12">
								<div class="form-group {{ $errors->has('diagnosis')?'has-error':''}}">
									<label class="control-label" for="diagnosis">Diagnosis</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>
										<textarea   name="diagnosis" id="diagnosis" class="form-control" cols="30" rows="3" style="resize: none;">{{old('diagnosis')}}</textarea>
									</div>
									<span class="help-block">{{$errors->first('diagnosis')}}</span>
								</div>
							</div>
						</div>
						{{-- .row --}}
						<div class="row">
							<div class="col-md-12 col-xs-12">
								<div class="form-group {{ $errors->has('advise')?'has-error':''}}">
									<label class="control-label" for="advise">Advise</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>
										<textarea   name="advise" id="advise" class="form-control" cols="30" rows="3" style="resize: none;">{{old('advise')}}</textarea>
									</div>
									<span class="help-block">{{$errors->first('advise')}}</span>
								</div>
							</div>

							
						</div>
						{{-- .row --}}

						<div class="row">
							<div class="col-md-6 col-xs-12">
								<div class="form-group {{ $errors->has('pathology')?'has-error':''}}">
									<label class="control-label" for="pathology">Recommended Clinical Follow up</label>
									<select name="pathology[]" id="pathology" class="js-example-basic-multiple  form-control" multiple="multiple">
										@foreach ($pathologies as $pathology)
										<option value="{{$pathology->id}}">{{$pathology->name}}</option>
										@endforeach
									</select>
									<span class="help-block">{{$errors->first('pathology')}}</span>
								</div>
							</div>

							<div class="col-md-2 col-xs-12">
								<div class="form-group {{ $errors->has('followuptype')?'has-error':''}}">
									<label class="control-label" for="followuptype">Follow up after</label>
									<select name="followuptype" id="followuptype" class="js-example-basic-single form-control">
										<option value="SOS">SOS</option>
										<option value="Days" >Days</option>
										<option value="Months" >Months</option>
									</select>
									<span class="help-block">{{$errors->first('followuptype')}}</span>
								</div>
							</div>
							<div class="col-md-1 col-xs-12">
								<div class="form-group  {{ $errors->has('numdays')?'has-error':''}}">
									<label class="control-label" id="numdayslabel" for="numdays"></label>
									<select name="numdays" id="numdays" class="js-example-basic-single form-control">
										{{-- appending values between 1 and 31 using jquery --}}
									</select>
									<span class="help-block">{{$errors->first('numdays')}}</span>
								</div>
							</div>
							<div class="col-md-3 col-xs-12">
								<div class="form-group ">
									<label class="control-label" id="nextvisitlabel" for="nextvisit">Follow up on(mm/dd/yyyy)</label>
									<input type="text" class="form-control" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask name="nextvisit" id="nextvisit">
								</div>
							</div>
						</div>{{-- .row --}}
						{{-- 						{{$client->contactperson[]}} = {{['name'=>'John Doe', 'phone'=>'0123456789']}}; --}}
					</div>
					<!-- /.box-body -->
					<div class="box-footer clearfix">
						<div class="row">
							<div class="col-md-6">
								<button type="submit"  class="form-group btn btn-success btn-block">Save Consultation</button>
							</div>
							<div class="col-md-6">
								<a href="{{route('patients.show',$patient->id)}}" class="form-group btn btn-danger btn-block">Cancel</a>
							</div>
						</div>
					</div>
					<!-- /.box-footer -->
				</form>
			</div>
		</div>
	</div>
	{{-- .row --}}

	{{-- {{$patient->visits}} --}}
	<div class="row">
		<div class="col-md-12">
			<div class="box box-solid box-primary">
				<div class="box-header">
					@if (Auth::user()->isRemoteDoc)
					<h3 class="box-title">Patient Visit (Kenya Time)</h3>
					@else
					<h3 class="box-title">Patient Visit (Indian Time)</h3>
					@endif
				</div>{{-- .box-header --}}

				<div class="box-body">
					<div class="box-group" id="accordion">
						<?php $count=1; ?>
						@foreach ($patient->visits as $visit){{-- .loop a --}}
						<div class="panel box {{$visit->user->isRemoteDoc?'box-primary':'box-warning'}}">
							<div class="box-header with-border">
								<h4 class="box-title">
									<a data-toggle="collapse" data-parent="#accordion" href="#collapse{{$count}}">
										@if (Auth::user()->isRemoteDoc)
										{{$visit->created_at->timezone('Africa/Nairobi')->toDayDateTimeString()}}
										@else
										{{$visit->created_at->timezone('Asia/Kolkata')->toDayDateTimeString()}}
										@endif
									</a>
								</h4>
							</div>
							<div id="collapse{{$count}}" class="panel-collapse collapse">
								<div class="box-body">
									<span class="badge bg-gray pull-right">Consultant: DR. {{$visit->user->name}}</span>
									@if ($visit->user->isRemoteDoc)
									<dl>
										<dt>Chief Complaints</dt>
										<dd>{{$visit->rem_complaints}}</dd>
										<dt>Patient History</dt>
										<dd>{{$visit->rem_history}}</dd>
										<dt>Doctor Notes</dt>
										<dd>{{$visit->rem_notes}}</dd>
									</dl>
									@if (count($visit->reports)>0)
									<table class="table table-bordered text-center">
										<thead style="background-color: #C0C0C0;">
											<th>Investigation Name</th>
											<th>Investigation Category</th>
											<th>Date of Investigation</th>
											<th>View Investigations</th>
										</thead>
										<tbody>
											@foreach ($visit->reports as $report)
											<tr>
												<td>
													{{$report->name}}
													<span class="label label-primary pull-right">
														{{$report->images()->count()}}
													</span>
												</td>
												<td>{{$report->cat_name}}</td>
												<td>{{$report->report_date}}</td>
												<td>
													@foreach ($report->images as $image)
													<a href="{{url($image->file_path)}}" data-lightbox="myreports{{$report->id}}" >
														<img id="report-images" src="{{url($image->file_path)}}" alt="">
													</a>
													@endforeach
												</td>
											</tr>
											@endforeach
										</tbody>
									</table>
									@else
									<div class="row">
										<div class="col-md-12">
											<div class="callout callout-info">
												<h4>No Reports Found!!</h4>
												<p>There are no reports found for this Patient Visit.</p>
											</div>
										</div>
									</div>
									@endif
									@else{{-- .if not Remote Doc then this --}}
									<dl>
										<dt>Chief Complaints</dt>
										<dd>{{$visit->chiefcomplaints}}</dd>
										<dt>Examination Findings</dt>
										<dd>{{$visit->examinationfindings}}</dd>
										<dt>History</dt>
										<dd>{{$visit->patienthistory}}</dd>
										<dt>Diagnosis</dt>
										<dd>{{$visit->diagnosis}}</dd>
										<dt>Advise</dt>
										<dd>{{$visit->advise}}</dd>
										<dt>Follow Up Date</dt>
										@if ($visit->isSOS)
										<dd>On SOS or With Reports</dd>
										@else
										<dd>{{$visit->nextvisit}}</dd>
										@endif
										<dt>Recommended Clinical Followup</dt>
										<ul>
											@foreach ($visit->pathologies as $pathology)
											<li>{{$pathology->name}}</li>
											@endforeach
										</ul>
									</dl>
									@if (Auth::user()->isRemoteDoc)
									<div class="box-footer clearfix">
										<a href="#" class="btn btn btn-success  pull-right">Print</a>
									</div>{{-- expr --}}
									@endif

									@endif
								</div>{{-- .box-body --}}
							</div>
						</div>{{-- .panel --}}
						<?php $count++; ?>
						@endforeach{{-- .outer $patient->visits as $visit loop, end of loop a --}}
					</div>
				</div>{{-- .box-body --}}
			</div>{{-- .box --}}
		</div>
	</div>
	{{-- .row --}}
	@else
	<div class="row">
		<div class="col-md-12 ">
			<div class="box box-default">
				<div class="box-header with-border">
					<i class="fa fa-exclamation-circle"></i>
					<h3 class="box-title">No Patient visits found</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="callout callout-info">
						<h4>No Patient Visits Found!!</h4>

						<p>Primary Consultation data for this patient has not been entered!!</p>
					</div>
				</div>
				<!-- /.box-body -->
			</div>
		</div>
	</div>
	@endif
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<a href="{{route('patients.show',$patient->id)}}" class="btn btn-primary btn-block"><< Back</a>
		</div>
	</div>
	@stop

	@section('scripts')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
	<script>
		$(document).ready(function(){
			$(".js-example-basic-multiple").select2();
			//Datemask dd/mm/yyyy
			$("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
    		//Datemask2 mm/dd/yyyy
    		$("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
    		//Money Euro
    		$("[data-mask]").inputmask();
    		//console.log( "document loaded Dilip" );
    		$("#numdayslabel").hide();
    		$('#numdays').hide();
    		$("#nextvisitlabel").hide();
    		$("#nextvisit").hide();
			//$('#days').find('option[value="SOS"]').attr("selected", "selected");
			$("#followuptype").val("SOS").change();
			
			$("#followuptype").change(function(){
				$(this).find("option:selected").each(function(){
					var optionValue = $(this).attr("value");
					if(optionValue == "SOS"){
						$("#numdayslabel").hide();
						$("#numdays").hide();
						$("#nextvisitlabel").hide();
						$("#nextvisit").hide();
					} else if(optionValue == "Days"){
						$("#nextvisitlabel").show();
						$("#nextvisit").show();
						$("#numdayslabel").text("(Days)");
						$("#numdayslabel").show();
						$("#numdays").show();
						$("#numdays").empty();
						//$('#numdays').append($('<option></option>').val('').html(''));
						$('#numdays').append($('<option></option>').val('1').html('1'));
						$('#numdays').append($('<option></option>').val('2').html('2'));
						$('#numdays').append($('<option></option>').val('3').html('3'));
						$('#numdays').append($('<option></option>').val('4').html('4'));
						$('#numdays').append($('<option></option>').val('5').html('5'));
						$('#numdays').append($('<option></option>').val('6').html('6'));
						$('#numdays').append($('<option></option>').val('7').html('7'));
						$('#numdays').append($('<option></option>').val('8').html('8'));
						$('#numdays').append($('<option></option>').val('9').html('9'));
						$('#numdays').append($('<option></option>').val('10').html('10'));
						$('#numdays').append($('<option></option>').val('11').html('11'));
						$('#numdays').append($('<option></option>').val('12').html('12'));
						$('#numdays').append($('<option></option>').val('13').html('13'));
						$('#numdays').append($('<option></option>').val('14').html('14'));
						$('#numdays').append($('<option></option>').val('15').html('15'));
						$('#numdays').append($('<option></option>').val('16').html('16'));
						$('#numdays').append($('<option></option>').val('17').html('17'));
						$('#numdays').append($('<option></option>').val('18').html('18'));
						$('#numdays').append($('<option></option>').val('19').html('19'));
						$('#numdays').append($('<option></option>').val('20').html('20'));
						$('#numdays').append($('<option></option>').val('21').html('21'));
						$('#numdays').append($('<option></option>').val('22').html('22'));
						$('#numdays').append($('<option></option>').val('23').html('23'));
						$('#numdays').append($('<option></option>').val('24').html('24'));
						$('#numdays').append($('<option></option>').val('25').html('25'));
						$('#numdays').append($('<option></option>').val('26').html('26'));
						$('#numdays').append($('<option></option>').val('27').html('27'));
						$('#numdays').append($('<option></option>').val('28').html('28'));
						$('#numdays').append($('<option></option>').val('29').html('29'));
						$('#numdays').append($('<option></option>').val('30').html('30'));
						$('#numdays').append($('<option></option>').val('31').html('31'));
						//$('#numdays').val('1');
						// $test =	$('#numdays').val();
						// console.log($test);
						//$("#numdays").val("").change();
						//$('#numdays').val('1').change();
						$test =	$('#numdays').val();
						$("#numdays").change(function(){
							$test =	$('#numdays').val();
							$mom = moment().add($test,'days').format('L');
							$('#nextvisit').val($mom);
						});
						$mom = moment().add($test,'days').format('L');
						
						// $date = new Date();
						// $curr_date = $date.getUTCDate();
						// $curr_month = $date.getUTCMonth();
						// $curr_month++;
						// $curr_year = $date.getUTCFullYear();
						// $date1 = $curr_date + "-" + $curr_month + "-" + $curr_year;
						//$('#test').val($date1)
						
						$('#nextvisit').val($mom);
						//console.log($curr_date + "-" + $curr_month + "-" + $curr_year);
						console.log($mom);
					}else if(optionValue == "Months"){
						$("#nextvisitlabel").show();
						$("#nextvisit").show();
						$("#numdayslabel").text("(Months)");
						$("#numdayslabel").show();
						$("#numdays").show();
						$("#numdays").empty();
						$('#numdays').append($('<option></option>').val('1').html('1'));
						$('#numdays').append($('<option></option>').val('2').html('2'));
						$('#numdays').append($('<option></option>').val('3').html('3'));
						$('#numdays').append($('<option></option>').val('4').html('4'));
						$('#numdays').append($('<option></option>').val('5').html('5'));
						$('#numdays').append($('<option></option>').val('6').html('6'));
						$('#numdays').append($('<option></option>').val('7').html('7'));
						$('#numdays').append($('<option></option>').val('8').html('8'));
						$('#numdays').append($('<option></option>').val('9').html('9'));
						$('#numdays').append($('<option></option>').val('10').html('10'));
						$('#numdays').append($('<option></option>').val('11').html('11'));
						$('#numdays').append($('<option></option>').val('12').html('12'));
						$test =	$('#numdays').val();
						$("#numdays").change(function(){
							$test =	$('#numdays').val();
							$mom = moment().add($test,'months').format('L');
							$('#nextvisit').val($mom);
						});
						$mom = moment().add($test,'months').format('L');
						$('#nextvisit').val($mom);
					}
				});
});
});
</script>
@stop