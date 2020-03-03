<?php
$sRequired = "required";
?>
<div class="col-md-6">
	@include('admin/templates/testing_template')
</div>
<div class="col-md-6">
	<div class="box box-default">
		<div class="box-body">
			<div class="form-group">
				{!! Form::label('Image') !!}
				<input type="file" uploader="uploader" id="img" name="file" accept=".jpg,.jpeg,.png,.gif,.bmp">
			</div>
			<div class="form-group">
				{!! Form::label('Description *') !!}
				{!! Form::textarea('description', "<br> As shared in our earlier communications, the Sales Organization at incubator embared on a journey of significantly elevating its bar with the expectation of delivering top tier in-store execution, realigning its product portfolio as per market potential, optimizing our route to Market, maximizing our revenue management capabilities and most importantly building a high performance, KPI focused sales team.<br>
				<br>In light of the same, weare pleased to announce that the revised Rural Development Structure now has a dedicated, cluster-based team for increased focus and sustainable competitive advantage. This structure will report into Rural Development Manager, Malik Ajmal Khan.<br>
				<br>The following role changes have been put in place and will be effective from the 1st February 2019.
				<br>
				<br>-- Shakeel Maqsood's role has been enriched, enabling him to better utilize his competenc, skills and business acumen for decision making and greater results. With his vast experience of the territory, we are expecting his inclusion will drive tremendous value in our quest to win in Rural Development Business. He will now be re designated as Zonal Sales Manager - Rural Development North for the Rural Development Business in Gujranwala & Rawalpindi Regions.<br>
				<br>-- The role of Syed Noshaad Ali, Zonal Sales Manager - Rural has been re-designated a Zonal Sales Manager ⁠— Rural Development Central for the Rural Development Business in Lahore & Faislabad Regions. Over the course of time, Noshad has been a consistent high performer and acheived various milestones with his rich experience, knoowledge and skill sets.<br>
				<br>We are confident that these organizational structure adjustments will fuel delivery of our sales objectives and will further strengthen our Rural Development Division, resulting in specific goals, objectives and a better framework for benchmarking in the insudtry.<br>
				<br>We wish all of them the best of luck for setting in their new roles and hope that they will continue to out-perform themselves.<br> ", array('class' => 'form-control ckeditor description', 'id' => 'ckeditor', $sRequired) ) !!}
			</div>
			<div class="form-group">
				{!! Form::label('Regards *') !!}
				{!! Form::textarea('regards', "Department of Human Resources,  <br> Tel:  | URL: www..com", array('class' => 'form-control regards ckeditor', 'id' => 'ckeditorRegards',$sRequired) ) !!}
			</div>
			<div class="form-group">
				{!! Form::label('Emails *') !!}
				{!! Form::select('emails[]',$aEmails,null,['class' => 'form-control select2','multiple'=>'multiple',$sRequired]) !!}
			</div>
			<div class="row">
				<div class="col-sm-6">
					<button type="submit" class="btn btn-primary btn-block btn-flat">Submit</button>
				</div>
				<div class="col-sm-6">
					<a href="{{ url('admin/templates')}}" class="btn btn-default btn-block btn-flat">Back</a>
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