<?php
$sRequired = "required";
?>
<div class="col-md-6">
	@include('admin/templates/holiday_template')
</div>
<div class="col-md-6">
	<div class="box box-default">
		<div class="box-body">
			<div class="form-group">
				{!! Form::label('Image') !!}
				<input type="file" uploader="uploader" id="img" name="file" accept=".jpg,.jpeg,.png,.gif,.bmp">
			</div>
			<div class="form-group">
				{!! Form::label('Location Details *') !!}
				{!! Form::text('location', null, array('class' => 'form-control location',$sRequired) ) !!}
			</div>
			<div class="form-group">
				{!! Form::label('Date *') !!}
				{!! Form::text('date', null, array('class' => 'form-control date', "data-provide"=>"datepicker",$sRequired) ) !!}
			</div>
			<div class="form-group">
				{!! Form::label('Day *') !!}
				{!! Form::text('day', null, array('class' => 'form-control day',$sRequired) ) !!}
			</div>

			<div class="form-group">
				{!! Form::label('Regards *') !!}
				{!! Form::textarea('regards', "Department of Human Resources, ", array('class' => 'form-control regards ckeditor', 'id' => 'ckeditorRegards',$sRequired) ) !!}
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
	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e) {
				$('#img-upload').attr('src', e.target.result);
			};
			reader.readAsDataURL(input.files[0]);
		}
	}
	$("#img").change(function () {
		readURL(this);
		$('#img-upload-div').css('display','block');
	});
	$(".location").keyup(function () {
		$('#location').html(this.value);
	});
	$(".day").keyup(function () {
		$('#day').html(this.value);
	});
	$(".regards").keyup(function () {
		$('#regards').html(this.value);
	});
	var date = new Date();
	jQuery('[data-provide="datepicker"]').datepicker({
		autoclose: true,
		autoSize: true,
		format: "d MM yyyy",
		startDate: new Date(date.getFullYear(), 0, 1),
		endDate: new Date(date.getFullYear(), 11, 31),
		active: true
	}).on('change', function () {	    	
		if($(this).hasClass('date')){
			$('#date').html(this.value);
		}
	});
	CKEDITOR.on('instanceCreated', function (e) {
		e.editor.on('change', function (event) {
		var regards = CKEDITOR.instances['ckeditorRegards'].getData();//Value of Editor
		$('#regards').html(regards);
	});
	});
</script>