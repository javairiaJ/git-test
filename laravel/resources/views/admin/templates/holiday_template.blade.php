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
<div style="width:auto;border-style: solid; border-color: #DA70D6; height:200px; margin-bottom: 20px;padding: 10px;">
	
	<p>Dear All,</p>

	<p>This is to announce that <strong><span id="location"><?php echo (isset($location))? $location: '{LOCATION}'; ?></span></strong> will remain closed on <strong><span id="date"><?php echo (isset($date))? $date: '{DATE}'; ?></span></strong> on account of <strong><span id="day"><?php echo (isset($day))? $day: '{DAY}'; ?></span></strong></p>
	

	@if(isset($file))
	<?php $file = asset('uploads/notifications/'.$file); ?>
	<img id='img-uploaded' src="<?php echo $file; ?>" class="col-sm-3 img-circle1" alt="Holiday Image" style="width:25% ;
    left: 600px;
    top: -49px;">
	@endif
	<div id='img-upload-div' style="display: none;">
		<img id='img-upload' class="col-sm-3 img-circle1" alt="Holiday Image" style="width:30%;  position: relative; left: -0.5%; top:50%; ">
		
	</div>

	<!-- <p>&nbsp;</p> -->
</div>
<br>
<p>Regards,</p>
<div style="margin-bottom:10px;" id="regards">
	<?php echo (isset($regards))? $regards: '<strong>{REGARDS}</strong>'; ?>
</div>
<div align="left">
	<img src="{{ asset('front\images\logo.PNG') }}" style="width: 400px;margin-bottom: 2px;"> 	
</div>
