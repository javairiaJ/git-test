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
<!-- <div style="width: 100%; padding: 2px ; height: auto; border-style: solid; border-color: black; "> -->
	<table style=" border-style: solid; border-color: #DA70D6; height:auto; width: auto; ">

		<tr>
			<td style="width: 2cm"></td>

			<td style="width: 80cm">
				<div style="padding:8px; box-sizing:border-box;font-family:sans-serif; "> 

						<p>Dear All,</p>

						<div style="margin-bottom:10px;" id="description">
							<?php echo (isset($description))? $description: '<strong>{DESCRIPTION}</strong>'; ?>
						</div>
						@if(isset($image))
						<?php $image = asset('uploads/notifications/'.$image); ?>
						<div >
						<img id='img-uploaded' src="<?php echo $image; ?>" class="col-sm-3 img-circle1" alt="Image" style="width: 100%; padding: 0px 230px 15px 230px;" >
					</div>
					
						@endif
						<div id='img-upload-div' style="display: none;">
							<img id='img-upload' class="col-sm-3 img-circle1" alt="Image" style="width:100%; position: relative; left: -0.5%;">
						</div>
						
					</div>


				<p>&nbsp;</p>
					

</td>
<td style="width: 2cm"></td>	
</tr>		

</table>

<br>
@if(isset($file))
<div style="margin-bottom:10px;">
	<strong>File: </strong>
	<?php $filePath = asset('uploads/notifications/'.$file); ?>
	<a href="<?php echo $filePath; ?>" download>
		<?php echo $file; ?>
	</a>
</div>
@endif
<div >
	<dt> Kind Regards,</dt>
	<div style="margin-bottom:10px;" id="regards">
		<?php echo (isset($regards))? $regards: '<strong>{REGARDS}</strong>'; ?>
	</div>
</div>
<div align="left">
	<img src="{{ asset('front\images\logo.PNG') }}" style="width: 400px;margin-bottom: 2px;"> 	
</div>

<!-- </div> -->
