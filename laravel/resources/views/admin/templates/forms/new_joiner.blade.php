<?php
$sRequired = "required";
?>
<div class="col-md-6">
	@include('admin/templates/new_joiner_template')
</div>
<div class="col-md-6">
	<div class="box box-default">
		<div class="box-body">
			<div class="form-group">
				{!! Form::label('Image') !!}
				<input type="file" uploader="uploader" id="img" name="file" accept=".jpg,.jpeg,.png,.gif,.bmp">
			</div>
			<div class="form-group">
				{!! Form::label('Name *') !!}
				{!! Form::text('name', null, array('class' => 'form-control name',$sRequired) ) !!}
			</div>
			<div class="form-group">
				{!! Form::label('Designation *') !!}
				{!! Form::text('designation', null, array('class' => 'form-control designation',$sRequired) ) !!}
			</div>
			<div class="form-group">
				{!! Form::label('Description *') !!}
				{!! Form::textarea('description', "
			
				Dear All,<br>
				<br>
				
				<br>
				Welcome to the  Family Hammad!<br>
				", array('class' => 'form-control ckeditor description', 'id' => 'ckeditor', $sRequired) ) !!}
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
				{!! Form::label('To  *') !!}
				{!! Form::select('emails[]',$aEmails,null,['class' => 'form-control select2','multiple'=>'multiple',$sRequired]) !!}
			</div>
			<div class="row">
				<div class="col-sm-6">
					<button type="submit" class="btn btn-primary btn-block btn-flat" style="background-color: #2F4F4F;">Send</button>
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
	$(".name").keyup(function () {
		$('#name').html(this.value);
	});
	$(".designation").keyup(function () {
		$('#designation').html(this.value);
	});
	CKEDITOR.on('instanceCreated', function (e) {
		e.editor.on('change', function (event) {
		var value = CKEDITOR.instances['ckeditor'].getData();//Value of Editor
		$('#description').html(value);
		var regards = CKEDITOR.instances['ckeditorRegards'].getData();//Value of Editor
		$('#regards').html(regards);
	});
	});
</script>