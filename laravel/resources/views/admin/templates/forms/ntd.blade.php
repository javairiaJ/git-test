<?php
$sRequired = "required";
?>
<div class="col-md-6">
	@include('admin/templates/ntd_template')
</div>
<div class="col-md-6">
	<div class="box box-default">
		<div class="box-body">
			<div class="form-group">
				{!! Form::label('Description *') !!}
				{!! Form::textarea('description',"

				
				<br>We wish all of them the best of luck for setting in their new roles and hope that they will continue to out-perform themselves.<br> 

				"
				, array('class' => 'form-control ckeditor description1', 'id' => 'ckeditor', $sRequired) ) !!}
			</div>
			<div class="form-group">
				{!! Form::label('Image') !!}
				<input type="file" uploader="uploader" id="img" name="image" accept=".jpg,.jpeg,.png,.gif,.bmp">
			</div>
			<div class="form-group">
				{!! Form::label('File') !!}
				<input type="file" name="file" accept=".doc,.docx,.pdf,.xls,.xlsx">
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
	CKEDITOR.on('instanceCreated', function (e) {
		e.editor.on('change', function (event) {
		var value = CKEDITOR.instances['ckeditor'].getData();//Value of Editor
		$('#description').html(value);
		var regards = CKEDITOR.instances['ckeditorRegards'].getData();//Value of Editor
		$('#regards').html(regards);
	});
	});
</script>