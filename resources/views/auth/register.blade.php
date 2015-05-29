@extends('app')

@section('content')

    <style>
        .popover-content {
            padding: 7px 35px;
            width: 295px;
            min-height: 40px;
            color: #fff;
        }
        .login-form form .form-area .fa-warning{
            color: #fff;
        }
    </style>

<!-- Start Page Header -->
<div class="page-header">
    <h1 class="title">Акаунти</h1>
    <ol class="breadcrumb">
        <li class="active">Форма достъпна само за администратори - за добвяне и коригиране на акаунти</li>
    </ol>
</div>
<!-- End Page Header -->
<div class="login-form">
    {!! Form::open(['data-remote-account','method'=>'post','url'=>'auth/register']) !!}
        <div class="top">
            <h1>Регистрация</h1>
            <h4>Регистриране на нов служител</h4>
        </div>
        <div class="form-area">
            <div class="group">
                <!-- Form Input -->
                    {!! Form::text('name',null,['class' => 'form-control','placeholder'=>'Име']) !!}
                <div class="popover fade right in" role="tooltip" id="popover963288" style="top: -5px; left: 278px; display: block; display:none;">
                    <div class="arrow"></div>
                    <i class="fa fa-warning"></i>
                    <div id="name_error" class="popover-content"></div>
                </div>
                <div id ="name_error"></div>

                <i class="fa fa-user"></i>
            </div>
            <div class="group">
                {!! Form::text('email',null,['class' => 'form-control','placeholder' => 'Имейл']) !!}
                <div class="popover fade right in" role="tooltip" id="popover10953" style="top: -5px; left: 278px; display: block; display: none;">
                    <div class="arrow"></div>
                    <i class="fa fa-warning"></i>
                    <div id="email_error" class="popover-content"></div>
                </div>
                <i class="fa fa-envelope-o"></i>
            </div>
            <div class="group">
                {!! Form::password('password',['class' => 'form-control','placeholder' => 'Парола']) !!}
                <div class="popover fade right in" role="tooltip" id="popover789287" style="top: -5px; left: 278px; display: block; display: none;">
                    <div class="arrow"></div>
                    <i class="fa fa-warning"></i>
                    <div id="password_error" class="popover-content"></div>
                </div>
                <i class="fa fa-key"></i>
            </div>
            <div class="group">
                {!! Form::password('password_confirmation',['class' => 'form-control','placeholder' => 'Потвърди парола']) !!}
                <i class="fa fa-key"></i>
            </div>
            <button type="submit" class="btn btn-default btn-block">Продължи</button>
        </div>
    {!! Form::close() !!}
    <br>

</div>

<script type="text/javascript">
$(document).ready(function(){

    var submitAjaxAccountCreate = function (e){
        var form = $(this);
        index = ['name','email','password'];
        hideIt = [];
        data = form.serialize();
        $.ajax({
            type: 'POST',
            url: form.prop('action'),
            data: data,
            success:function(data){
                if(data.fail){

                    $.each(data.errors, function( index, value ) {
                        var errorDiv = '#'+index+'_error';
                            $(errorDiv).addClass('required');
                            $(errorDiv).empty().append(value);
                            hideIt.push(index);
                    });
                    index.forEach(function(enter){
                        if( hideIt.indexOf(enter) == -1){
                            var errorDiv = '#'+enter+'_error';
                            $(errorDiv).empty();
                            $(errorDiv).parent().fadeOut(250);
                        }else{
                            var errorDiv = '#'+enter+'_error';
                            $(errorDiv).parent().show();
                        }
                    });
                }else{
                    $('#name_error').empty();
                    $('#name_error').parent().hide();
                    $('#email_error').empty();
                    $('#email_error').parent().hide();
                    $('#password_error').empty();
                    $('#password_error').parent().hide();
                }
            }
        });
        e.preventDefault();
    }

    $("form[data-remote-account]").on('submit',submitAjaxAccountCreate);

});
</script>
@endsection