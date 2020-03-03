<?php
$sRequired = "required";
?>
<div class="col-md-6">
	@include('admin/templates/departure_template')
</div>
<div class="col-md-6">
	<div class="box box-default">
		<div class="box-body">
			<div class="form-group">
				{!! Form::label('Employee Details *') !!}
				{!! Form::text('employeeDetails', null, array('class' => 'form-control employeeDetails',$sRequired) ) !!}
			</div>
			<div class="form-group">
				{!! Form::label('Other Details *') !!}
				{!! Form::text('otherDetails', null, array('class' => 'form-control otherDetails',$sRequired) ) !!}
			</div>
			<div class="form-group">
				{!! Form::label('Contact Details *') !!}
				{!! Form::text('contactDetails', null, array('class' => 'form-control contactDetails',$sRequired) ) !!}
			</div>
			<div class="form-group">
				{!! Form::label('Regards *') !!}
				{!! Form::textarea('regards', "Department of Human Resources,", array('class' => 'form-control regards ckeditor', 'id' => 'ckeditorRegards',$sRequired) ) !!}
			</div>
			<div class="form-group">
				{!! Form::label('From Email *') !!}
				{!! Form::select('from_email', array('' => 'Select any one option') + $aEmailConfigurations,null,['class' => 'form-control select2',$sRequired]) !!}
			</div>
			<div class="form-group">
				{!! Form::label('To *') !!}
				{!! Form::select('emails[]',$aEmails,null,['class' => 'form-control select2','multiple'=>'multiple',$sRequired]) !!}
			</div>
			<div class="row">
				<div class="col-sm-6">
					<button type="submit" class="btn btn-primary btn-block btn-flat" style="background-color: #2F4F4F; color: #fff;">Send</button>
				</div>
				<div class="col-sm-6">
					<a href="{{ url('admin/templates')}}" class="btn btn-default btn-block btn-flat" style="background-color: #2F4F4F; color: #fff;">Back</a>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(".employeeDetails").keyup(function () {
		$('#employeeDetails').html(this.value);
	});
	$(".otherDetails").keyup(function () {
		$('#otherDetails').html(this.value);
	});
	$(".contactDetails").keyup(function () {
		$('#contactDetails').html(this.value);
	});
	CKEDITOR.on('instanceCreated', function (e) {
		e.editor.on('change', function (event) {
		var regards = CKEDITOR.instances['ckeditorRegards'].getData();//Value of Editor
		$('#regards').html(regards);
	});
	});
</script>