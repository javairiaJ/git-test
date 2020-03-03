
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

<table align="left"  style=" border-style: solid; border-color: #DA70D6; height:auto; width: auto; ">
	<tbody>
		<tr>
			<td style="vertical-align:top; padding: 5px;">
				<br>
				<p>Dear All,
					<br>
					It is announced with deep regret of the sad demise of the <strong><span id="employeeDetails"><?php echo (isset($employeeDetails))? $employeeDetails: '{Employee Details}'; ?></span></strong></p>

					<p>Namaz-e-Janaza&nbsp;will be offered <strong><span id="otherDetails"><?php echo (isset($otherDetails))? $otherDetails: '{Other Details}'; ?></span></strong> Please join us in praying for the departed soul as our heartfelt condolences go out to the bereaved family. May Allah give them the strength to bear this loss.</p>
					<p><br />
						<strong><span id="contactDetails"><?php echo (isset($contactDetails))? $contactDetails: '{Contact Details}'; ?></span></strong></p>

						
					</td>
				</tr>
			</tbody>
		</table>
		<p>&nbsp;</p>

		<p>Kind Regards,</p>
		<div style="margin-bottom:10px;" id="regards">
		<?php echo (isset($regards))? $regards: '<strong>{REGARDS}</strong>'; ?>
		</div>
		<div align="left">
	<img src="{{ asset('front/images/logo.PNG') }}" style="width: 400px;margin-bottom: 2px;"> 	
</div>

