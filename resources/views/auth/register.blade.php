@extends('app')

@section('content')

    <style>
        .popover-content {
            color: #fff;
            width: 275px;
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

        #avatar-upload{
            width: 70px;
            height: 70px;
            border: dashed 2px;
            border-radius: 50%;
            overflow: hidden;
        }

        #avatar-upload canvas{
            width: 70px;
            height: 70px;
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


        <div class="col-md-12 col-lg-5 registration-form">
            <div class="panel panel-default">
                <div class="panel-title">
                    Регистрация
                    <ul class="panel-tools">
                        <li><a class="icon minimise-tool"><i class="fa fa-minus"></i></a></li>
                    </ul>
                </div>

                <div class="panel-body" style="display: none;">
                    {!! Form::open(['data-remote-account','method'=>'post','url'=>'auth/register']) !!}
                    <div class="group">
                        <div id="avatar-upload"></div>
                    </div>
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
                        <select name="categories[]" id="example-multiple-optgroups" multiple="multiple">
                            @foreach($root_categories as $root)
                                <optgroup label="{{ $root->name }}">
                                    @foreach($categories as $category)
                                        @if($root->id == $category->parent_id)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endif
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <select name="role">

                            @foreach($roles as $role)
                                @if($role->name == 'Base')
                                    <option value="{{ $role->id }}"  selected>{{ $role->name }}</option>
                                @else
                                    <option value="{{ $role->id }}" >{{ $role->name }}</option>
                                @endif
                            @endforeach

                        </select>
                    </div>
                    <button id="start-upload" type="submit" class="btn btn-light btn-pos">Регистрирай</button>
                    {!! Form::close() !!}

                </div>

            </div>
        </div>

    </div>
    <script type="text/javascript">
        $('#example-multiple-optgroups').multiselect({
            enableFiltering: true,
            enableClickableOptGroups: true,
            buttonWidth: '340px'
        });
    </script>
    <script type="text/javascript" src="{{ URL::to('js/vendor/plupload/plupload.full.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::to('js/accountregister.js') }}"></script>
@endsection
