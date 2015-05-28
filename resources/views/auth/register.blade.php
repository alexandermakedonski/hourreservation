@extends('app')

@section('content')
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
                     <div id ="name_error"></div>
                <i class="fa fa-user"></i>
            </div>
            <div class="group">
                {!! Form::text('email',null,['class' => 'form-control','placeholder' => 'Имейл']) !!}
                <div id ="email_error"></div>
                <i class="fa fa-envelope-o"></i>
            </div>
            <div class="group">
                {!! Form::password('password',['class' => 'form-control','placeholder' => 'Парола']) !!}
                <div id ="password_error"></div>
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
                    });
                }else{
                    $('#name_error').empty();
                    $('#email_error').empty();
                    $('#password_error').empty();
                }
            }
        });
        e.preventDefault();
    }

    $("form[data-remote-account]").on('submit',submitAjaxAccountCreate);

});
</script>
@endsection