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


<table style=" border-style: solid; border-color: #DA70D6; height:auto; ">
	
	<tr>
		<td style="width: 8cm"></td>
		
		<td style="width: 90cm">
			<div style="margin-bottom:10px;" id="description">
				<?php echo (isset($description))? $description: '<strong>{DESCRIPTION}</strong>'; ?>
			</div>
			<p> &nbsp; </p>
			<div style="margin-bottom:10px;">
				@if(isset($file))
				<?php $file = asset('uploads/notifications/'.$file); ?>
				<img id='img-uploaded' src="<?php echo $file; ?>" class="col-sm-3 img-circle1" alt="Product Image" style="width:100%">
				@endif
				<div id='img-upload-div' style="display: none;">
					<img id='img-upload' class="col-sm-3 img-circle1" alt="Product Image" style="width:100%; position: relative; left: -0.5%;">
					<br>
				</div>
			</div>
			<p>&nbsp;</p>
			<br>
		</td>
		<td style="width: 8cm"></td>	
	</tr>		
	
</table>
<div style="margin-bottom:10px;">
	<br>
	<p>Kind Regards,</p>
	<div style="margin-bottom:10px;" id="regards">
		<?php echo (isset($regards))? $regards: '<strong>{REGARDS}</strong>'; ?>
	</div>
</div>
<div align="left">
	<img src="{{ asset('front\images\logo.PNG') }}" style="width: 400px;margin-bottom: 2px;"> 	
</div>

