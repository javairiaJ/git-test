@extends('front.layouts.app')

@section('content')
<?php
$required = 'required';
?>
<section class="dashboard-area">
    <div class="container">
        @include('front/commons/errors')
        <div class="dash__rgt col-sm-9">
            <div class="tab-content">
                <div id="profile" class="tab-pane fade active in">
                    <div class="profile__dtl col-sm-12">

                        {!! Form::model($user, ['files' => true,'class' => 'form','url' => ['profile/update'], 'method' => 'post']) !!}
                        <div class="form-group col-sm-4">
                            {!! Form::label('First Name *') !!}
                            {!! Form::text('firstName', null , array('class' => 'form-control',$required) ) !!}
                        </div>
                        <div class="form-group col-sm-4 ">
                            {!! Form::label('Last Name *') !!}
                            {!! Form::text('lastName', null , array('class' => 'form-control',$required) ) !!}
                        </div>

                        <div class="form-group col-sm-12">
                            {!! Form::label('Email *') !!}
                            {!! Form::text('email', null , array('class' => 'form-control','readonly'=>'readonly',$required) ) !!}
                        </div>
                        <div class="form-group col-sm-4 ">
                            {!! Form::label('Designation *') !!}
                            {!! Form::text('designation', null , array('class' => 'form-control',$required) ) !!}
                        </div>

                        <div class="col-md-12 fit__sub__reset clrlist">
                            <button type="submit" class="btn btn-success">Update</button>
                            <button type="button" onclick="window.location.href = '<?php echo url('profile'); ?>'" class="btn btn-default" onclick="back()">Back</button>
                        </div>

                        {!! Form::close() !!}
                    </div>
                </div>

            </div>
        </div>
    </div>

</section>  
@endsection