










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
			<td style="width: 1.5cm;"></td>
		
			<td style="width: 100cm;">
				<br>
<p>Dear <strong><span id="name"><?php echo (isset($name))? $name: '{NAME}'; ?></span></strong>,</p>

<p>Reference to your resignation dated <strong><span id="resignationDay"><?php echo (isset($resignationDay))? $resignationDay: '{Resignation Date}'; ?></span></strong>, which has been accepted by the management and your last working day will be <strong><span id="lastWorkingDay"><?php echo (isset($lastWorkingDay))? $lastWorkingDay: '{Last Working Day}'; ?></span></strong>.</p>
	<p>We would like to brief you about your final settlement procedure in order to ensure a smooth exit.</p>
	<p>In order to settle your final dues, please follow the below instructions:</p>
<table align="left">
	<tbody>
		<tr>
			<td style="vertical-align:top">
			<!-- <p>In order to settle your final dues, please follow the below instructions:</p> -->

			<p>&nbsp;&nbsp;</p>

			<table border="1" cellspacing="0" style="width:279.75pt">
				<tbody>
					<tr>
						<td style="background-color:white; width:279.75pt">
						<p>FOR EMPLOYEE PURPOSES</p>
						</td>
					</tr>
					<tr>
						<td style="background-color:white; width:279.75pt">
						<p>Fill out and submit the separation check list to HR Operation Team for Full &amp; Final Settlement</p>
						</td>
					</tr>
				</tbody>
			</table>

			<p>&nbsp;</p>

			<table border="1" cellspacing="0" style="width:279.75pt">
				<tbody>
					<tr>
						<td style="background-color:white; width:279.75pt">
						<p>Fill out and submit the exit interview form to HR Organization Development Team</p>
						</td>
					</tr>
					<tr>
						<td style="background-color:white; width:279.75pt">
						<p>Handover all IT &ndash; Asset(s) to Information Technology Department</p>
						</td>
					</tr>
				</tbody>
			</table>

			<p>&nbsp;</p>

			<table border="1" cellspacing="0" style="width:279.75pt">
				<tbody>
					<tr>
						<td style="background-color:white; width:279.75pt">
						<p>Handing over all files, documents and other allocated departmental assets to your supervisor / line manager</p>
						</td>
					</tr>
					<tr>
						<td style="background-color:white; width:279.75pt">
						<p>Handing over any other company assets / Float Money or Credit card / to their respective departments i.e&nbsp;Admin / Finance /&nbsp;Fair Price Shop</p>
						</td>
					</tr>
				</tbody>
			</table>
				</td> 
			<td style="width: 10cm;"></td>	
			<td style="width: 100cm;">
				<br>
<p></p>

<p></p>
	</tr>		
		
</table>

			<p>&nbsp;</p>

			<p >It is essential that you carry out all the prerequisite tasks to process your final settlement, In case you fail to handover any company possession(s) or if any department is not able to provide your clearance to HR, the HR department will not be able to provide your clearance.
				<br>
			ATTENTION: IT/ Finance/ Admin /&nbsp;Fair Price Shop kindly contact and coordinate in this regard with the employee.
			<br>
			The whole clearance process will take around 15 working days subject to your clearance from all departments, and your dues (salary and/or provident fund), if any, will be processed through cheque and&nbsp;handed over to you along with your experience&nbsp;letter. If you are unable to visit HR Office for your full &amp; final settlement in person, then you may authorize someone to collect your cheque, experience&nbsp;letter&nbsp;and&nbsp;sign-off&nbsp;your full &amp; final settlement on your behalf. For this, you must send an email or authority&nbsp;letter&nbsp;to us including your nominee&#39;s name, his/her national identity card number, and&nbsp;contact&nbsp;number.</p>
             <br>
		
			</td>
		</tr>
	</tbody>
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
<p>Thanks &amp; Regards,</p>
<div style="margin-bottom:10px;" id="regards">
	<?php echo (isset($regards))? $regards: '<strong>{REGARDS}</strong>'; ?>
</div>
<div align="left">
	<img src="{{ asset('front\images\logo.PNG') }}" style="width: 400px;margin-bottom: 2px;"> 	
</div>
