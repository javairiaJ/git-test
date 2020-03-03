<?php
$sRequired = "required";
?>
<div class="col-md-6">
	@include('admin/templates/security_template')
</div>
<div class="col-md-6">
	<div class="box box-default">
		<div class="box-body">
			<div class="form-group">
				{!! Form::label('Description *') !!}
				{!! Form::textarea('description', "Saudi Arabia Crown Prince,Mohammed Bin Salman is planned to visit Pakistan on February 16 for a two-day state visit. 
The crown prince is expected to stay at the Prime Minister House during his visit.<br> 
<br>
A brief run down of the security/traffic update is given in the suceeding paras :-<br> 
1. Number of security checkpoints will be established on the roads.<br> 
2. All entry points of the federal capital will be scrutinized through special arrangements during the two days of his presence in the country.<br>  
3. Most areas in the immediate vicinity of the Red Zone will remain closed.<br>  
4. Metro Bus service will remain limited to Rawalpindi Only.<br>  
5. Likely LEA deployments in and around the twin cities:<br>  
.", array('class' => 'form-control ckeditor description', 'id' => 'ckeditor', $sRequired) ) !!}
			</div>
			<div class="form-group">
				{!! Form::label('Regards *') !!}
				{!! Form::textarea('regards', "Col.(R)Khalid. M. Khan. TI(M) <br>Corporate Security ,Admin & Protocol <br>", array('class' => 'form-control regards ckeditor', 'id' => 'ckeditorRegards',$sRequired) ) !!}
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

	CKEDITOR.on('instanceCreated', function (e) {
		e.editor.on('change', function (event) {
		var value = CKEDITOR.instances['ckeditor'].getData();//Value of Editor
		$('#description').html(value);
		var regards = CKEDITOR.instances['ckeditorRegards'].getData();//Value of Editor
		$('#regards').html(regards);
	});
	});
</script>