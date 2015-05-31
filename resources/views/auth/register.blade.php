@extends('app')

@section('content')

    <style>
        .popover-content {
            color: #fff;
            width: 295px;
            min-height: 50px;
        }

        .registration-form form .group .fa-position {
            position: relative;
            top: 32px;
            left: 14px;
            font-size: 18px;
            color: #C3C3C3;
        }
        .registration-form form .group .form-postition {
            padding-left: 38px;
            height: 40px;
        }

        .open > .dropdown-menu {
            display: block;
            width: 350px;
        }
        .btn-pos{
            float: right;
        }

        .registration-form form .group .pop-warning{

            font-size: 16px;
            color: #B94A48;
            display: none;
            cursor: pointer;
            float: right;
            margin-top: -25px;
            display: none;
            padding-right: 10px;

        }

    </style>

    <!-- Start Page Header -->
    <div class="page-header">
        <h1 class="title">Акаунти</h1>
        <ol class="breadcrumb">
            <li class="active">Форма достъпна само за администратори - за добвяне и коригиране на акаунти</li>
        </ol>
    </div>
    <div class="row">


        <div class="col-md-12 col-lg-6 registration-form">
            <div class="panel panel-default">

                <div class="panel-title">
                    Регистрация
                    <ul class="panel-tools">
                        <li><a class="icon minimise-tool"><i class="fa fa-minus"></i></a></li>
                    </ul>
                </div>

                <div class="panel-body">
                    {!! Form::open(['data-remote-account','method'=>'post','url'=>'auth/register']) !!}
                    <div class="group">
                        <i class="fa-position fa fa-user"></i>
                        {!! Form::text('name',null,['class' => 'form-postition form-control','placeholder'=>'Име']) !!}
                        <i data-show-error="name" class="fa fa-warning pop-warning"></i>
                    </div>
                    <div class="group">
                        <i class="fa-position fa fa-envelope-o"></i>
                        {!! Form::text('email',null,['class' => 'form-postition form-control','placeholder' => 'Имейл']) !!}
                        <i data-show-error="email" class="fa fa-warning pop-warning"></i>
                    </div>
                    <div class="group">
                        <i class="fa-position fa fa-key "></i>
                        {!! Form::password('password',['class' => 'form-postition form-control','placeholder' => 'Парола']) !!}
                        <i data-show-error="password" class="fa fa-warning pop-warning"></i>
                    </div>

                    <div class="group">
                        <i class="fa-position fa fa-key"></i>
                        {!! Form::password('password_confirmation',['class' => 'form-postition form-control','placeholder' => 'Потвърди парола']) !!}
                    </div>
                    <br>
                    <div class="form-group">
                        <select id="example-multiple-optgroups" multiple="multiple">
                            <optgroup label="Group 1">
                                <option value="1-1">Option 1.1</option>
                                <option value="1-2">Option 1.2</option>
                                <option value="1-3">Option 1.3</option>
                            </optgroup>
                            <optgroup label="Group 2">
                                <option value="2-1">Option 2.1</option>
                                <option value="2-2">Option 2.2</option>
                                <option value="2-3">Option 2.3</option>
                            </optgroup>
                        </select>
                    </div>

                    <div class="form-group">
                        <select>

                            @foreach($roles as $role)
                                @if($role->name == 'Base')
                                    <option  selected data-role="{{\Hashids::encode($role->id,rand(0,100)) }}">{{ $role->name }}</option>
                                @else
                                    <option  data-role="{{\Hashids::encode($role->id,rand(0,100)) }}">{{ $role->name }}</option>
                                @endif
                            @endforeach

                        </select>
                    </div>
                    <button type="submit" class="btn btn-light btn-pos">Регистрирай</button>
                    {!! Form::close() !!}

                </div>

            </div>
        </div>

    </div>
    <script type="text/javascript">
        $('#example-multiple-optgroups').multiselect({
            enableFiltering: true,
            enableClickableOptGroups: true
        });
    </script>
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


                            $('[data-show-error]').hide().popover('hide');

                            $.each(data.errors, function( index, value ) {

                              var popover =  $('[data-show-error='+index+']').show().popover();
                                console.log(popover);
                              popover.attr('data-content', value);

                            });

                        }
                    }
                });
                e.preventDefault();
            }

            $("form[data-remote-account]").on('submit',submitAjaxAccountCreate);

        });
    </script>
@endsection
