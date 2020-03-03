


<?php
$profpic = "AT.jpg";
?>



<style type="text/css">
.fggg{
	 background-image: url({{ asset('/front/images/AT.jpg') }});
}	

</style>

<div class="fggg" >
<table style=" border-style: solid; border-color:#fff; height:auto; margin-top: -0.5cm; margin-right: : 20cm;">
	
	<tr>
            <th style="width: 35cm; height: 0.5cm">
            	<img src="{{ asset('front\images\logo.PNG') }}" style="width: 150px;margin-bottom: 2px;">
  
            </th>

            <th style="width: 40cm;height: 0.5cm"></th>
            <th style="width: 40cm;height: 0.5cm"></th>
            <th style="width: 40cm;height: 0.5cm"></th>
            <th style="width: 45cm;height: 0.5cm"></th>
            <th style="width: 35cm;height: 0.5cm;">
            	
            	<div align="right">
            	<img src="{{ asset('front\images\logo3.PNG') }}" style="width: 150px; margin-bottom: 2px;">
            	</div>
            </th>
        </tr>	
<br>
	<tr>
		<td style="width: 35cm;height: 0.3cm; background-color:#cd0011;"> 
		</td>
		<td style="width: 40cm;height: 0.3cm; background-color: #E78E0A;"> 
		</td>
		<td style="width: 40cm;height: 0.3cm; background-color: #E78E0A;"> 
		</td>
		<td style="width:40cm;height: 0.3cm; background-color: #f0ed18;">	
		</td>
		<td style="width:40cm;height: 0.3cm; background-color: #f0ed18;">	
		</td>
		<td style="width:35cm; height: 0.3cm;background-color: #87438e;">	
		</td>
	</tr>
</table>
<br>







<table style=" border-style: solid; border-color: #DA70D6; height:auto; width: auto; ">
    
	<tr>
		<td style="width: 2cm"></td>

		<td style="width: 80cm">
			
<h3>INTERNAL JOB POSTING</h3>
<p><strong><span id="jobPost"><?php echo (isset($jobPost))? $jobPost: '{JOB POST}'; ?></span></strong></p>
<p><strong><span id="area"><?php echo (isset($area))? $area: '{AREA}'; ?>
		
	</span></strong></p>


<div style="margin-bottom:10px;" id="description">
	<?php echo (isset($description))? $description: '<strong>{DESCRIPTION}</strong>'; ?>
</div>
@if(isset($image))
<?php $image = asset('uploads/notifications/'.$image); ?>
<img id='img-uploaded' src="<?php echo $image; ?>" class="col-sm-3 img-circle1" alt="Product Image" style="width:100%1">
@endif
<div id='img-upload-div' style="display: none;">
	<img id='img-upload' class="col-sm-3 img-circle1" alt="Product Image">
	<br>
</div>
</td>
		<td style="width: 2cm"></td>	
	</tr>		

</table>

@if(isset($file))
<div style="margin-bottom:10px;">
<strong>File: </strong>
<?php $filePath = asset('uploads/notifications/'.$file); ?>
<a href="<?php echo $filePath; ?>" download>
  <?php echo $file; ?>
</a>
</div>
@endif
<p>&nbsp;</p>
<p>Kind Regards,</p>
<div style="margin-bottom:10px;" id="regards">
	<?php echo (isset($regards))? $regards: '<strong>{REGARDS}</strong>'; ?>
</div>
<div align="left">
	<img src="{{ asset('front\images\logo.PNG') }}" style="width: 400px;margin-bottom: 2px;"> 	
</div>
</div>                                                                                                        

