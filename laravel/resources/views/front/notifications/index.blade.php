@extends('front.layouts.app')
@section('content')
<div class="container">
	<div class="content">
		<div class="col-xs-12">
			<span>
				<h4><i class="fa fa-lg fa-bell"></i> Notifications</h4>
			</span>

			<div class="list-group">
				@if(count($aNotifications)>0)
				@foreach($aNotifications as $oRow)
				<a href="{{ url('notification/'.$oRow->id) }}" class="list-group-item list-group-item-action list-group-item-dark">
					<?php echo stripslashes($oRow->description); ?>
					<span><time class="pull-right"><?php echo showTime($oRow->created_at) ?></time></span>
				</a>
				@endforeach
				@else
				<a href="#" class="list-group-item list-group-item-action list-group-item-dark">No Notification Found. . . </a>
				@endif
			</div>
		</div>
	</div>
</div>
@endsection
