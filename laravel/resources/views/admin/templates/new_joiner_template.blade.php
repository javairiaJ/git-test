<style>
/*.img-circle  {
  border-radius: 50%;
 border:10px solid #D4AF37;
  
 }*/
 .abcd{
 	border-radius: 50%;
 	border:10px solid #D4AF37;
 	/* border-image: :linear-gradient(to bottom right,#D4AF37, white);*/
 }
 .xyz{
 	border-radius: 50%;
 	border:10px solid #D4AF37;
 	/* border-image: :linear-gradient(to bottom right,#D4AF37, white);*/
 }
</style>
 <!-- position: absolute; top: 10%; -->



<div style="box-sizing:border-box;font-family:sans-serif;"> 
	<!-- <br><br><br><br> -->
	<div style="margin-bottom:10px;">   <!-- width:450px; -->
		@if(isset($file))
		<?php $file = asset('uploads/notifications/'.$file); ?>
		<img id='img-uploaded' src="<?php echo $file; ?>" class="abcd" alt="Product Image" style="width:150px; position: absolute;  left: 43%; margin-top: 30px; ">
		@endif
		<div id='img-upload-div' style="display: none;">
			<img id='img-upload' class="xyz" alt="Product Image" style="width:150px; position: absolute;  left: 37.5%;margin-top: 60px;">
			<br>
		</div>

	</div>
</div>

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

<table style="  height:auto; margin-top: 2cm; ">
	<tr>
		<th style="width:9.5cm"></th>

		<th style="width: 10.4cm ;text-align:center;">
			<h3 style="display:inline; color:#333; "><b>WELCOME</b></h3>
		</th>

		<th style="width: 8cm"></th>
	</tr>

	<tr>
		<td style="width: 6cm"></td>
		
		<td style="width: 9.5cm; text-align:center;">
			<h4 id="name" style="display:inline; color:#FFA500;"><b>
				<?php echo (isset($name))? $name: '{NAME}'; ?>
			</b><p></p>
		</h4>
		
	</td>
	<td style="width: 8cm"></td>
</tr>


<tr>
	<td style="width: 8cm"></td>

	<td style="width: 9cm; text-align:center;">
		<h3 style="display:inline; color: #FFA500;"><b> as </b></h3>  
	</td>
	<td style="width: 8cm;"></td>	
</tr>


<tr>
	<td style="width: 8cm"></td>

	<td style="width: 9.5cm; text-align:center;">
		<h4 id="designation" style="display:inline; color:#FFA500;"><b>
			<?php echo (isset($designation))? $designation: '{DESIGNATION}'; ?>
		</b></h4> 
	</td>
	<td style="width: 9cm"></td>	
</tr>


<tr>
</table>

<div style="width:auto;border-style: solid; border-color: #DA70D6; height:auto; margin-bottom: 20px;padding: 10px;" id="description">
	<p>
		<?php echo (isset($description))? $description: '<strong>{DESCRIPTION}</strong>'; ?>
	</p>
</div>

<p>Regards,</p>
<div style="margin-bottom:10px;" id="regards">
	<?php echo (isset($regards))? $regards: '<strong>{REGARDS}</strong>'; ?>
</div>


<div align="left">
	<img src="{{ asset('front\images\logo.PNG') }}" style="width: 400px;margin-bottom: 2px;"> 	
</div>

