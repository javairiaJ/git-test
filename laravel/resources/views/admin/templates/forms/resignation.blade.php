<?php
$sRequired = "required";
?>
<div class="col-md-6">
	@include('admin/templates/resignation_template')
</div>
<div class="col-md-6" style="margin-top: 20px;">
	<div class="box box-default">
		<div class="box-body" style="margin-top: 20px;">
			<div class="form-group">
				{!! Form::label('Name *') !!}
				{!! Form::text('name', null, array('class' => 'form-control name',$sRequired) ) !!}
			</div>
			<div class="form-group">
				{!! Form::label('Resignation Date *') !!}
				{!! Form::text('resignationDay', null, array('class' => 'form-control resignationDay', "data-provide"=>"datepicker",$sRequired) ) !!}
			</div>
			<div class="form-group">
				{!! Form::label('Last Working Day *') !!}
				{!! Form::text('lastWorkingDay', null, array('class' => 'form-control lastWorkingDay', "data-provide"=>"datepicker",$sRequired) ) !!}
			</div>
			<div class="form-group">
				{!! Form::label('File') !!}
				<input type="file" name="file" accept=".doc,.docx,.pdf,.xls,.xlsx">
			</div>
			<div class="form-group">
				{!! Form::label('Regards *') !!}
				{!! Form::textarea('regards', "Malik Abdul Rauf | ", array('class' => 'form-control regards ckeditor', 'id' => 'ckeditorRegards',$sRequired) ) !!}
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
					<a href="{{ url('admin/templates')}}" class="btn btn-default btn-block btn-flat" style="background-color: #2F4F4F; color: #fff; ">Back</a>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	    //Date picker
	    var date = new Date();
	    jQuery('[data-provide="datepicker"]').datepicker({
	    	autoclose: true,
	    	autoSize: true,
	    	format: "d MM yyyy",
	    	startDate: new Date(date.getFullYear(), 0, 1),
	    	endDate: new Date(date.getFullYear(), 11, 31),
	    	active: true
	    }).on('change', function () {	    	
	    	if($(this).hasClass('resignationDay')){
	    		$('#resignationDay').html(this.value);
	    	}
	    	if($(this).hasClass('lastWorkingDay')){
	    		$('#lastWorkingDay').html(this.value);
	    	}
	    });
	    $(".name").keyup(function () {
	    	$('#name').html(this.value);
	    });
	    CKEDITOR.on('instanceCreated', function (e) {
	    	e.editor.on('change', function (event) {
		var regards = CKEDITOR.instances['ckeditorRegards'].getData();//Value of Editor
		$('#regards').html(regards);
	});
	    });
	</script>