<p style="margin-bottom:0px;font-weight:bold;">Many thanks,</p>
<p style="margin-bottom:0px;font-weight:bold;">{{($emailSettings->companyName)?$emailSettings->companyName:''}}</p>
<br>
<div style="width:200px;margin-bottom:10px;"><img src="{{ ($emailSettings->companyLogo)?asset('uploads/email_settings/thumbnail/'.$emailSettings->companyLogo): asset('front/images/no_result.jpg') }}" alt="logo" style="width:100%">
</div>
@if(count($emailSocialLinks)>0)
<h4 style="margin-bottom:0px">Stay In Touch with us</h4>
@foreach($emailSocialLinks as $row)
<a href="{{$row->link}}" target="_blank" style="display:inline-block;float:left;">
    <img style="width:38px;height:38px;border-radius:50px;" src="{{ asset('front/images/emails/'.$row->type.'.png') }}">
</a>
@endforeach
@endif