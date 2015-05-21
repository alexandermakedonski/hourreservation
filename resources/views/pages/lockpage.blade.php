<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Студио шик модул">
    <meta name="keywords" content=студио,шик,запазване,час,отчети"/>
    <title>Студио ШИК запазване на час</title>

    <!-- ========== Css Files ========== -->
    <link href="{{ URL::asset('/css/all.css') }}" rel="stylesheet">
    <style type="text/css">
        body{
            background: #F5F5F5;
        }
    </style>
</head>
<body>

<div class="login-form">
    {!! Form::open(['url' => '/lock']) !!}
        <div class="top">
            <img src="/users/accounts/{{ $data[0]['profile_picture'] }}" alt="icon" class="icon profile">
            <h1>{{ $data[0]['name'] }}</h1>
            <h4>Отключване на екрана</h4>
        </div>
        <div class="form-area">
            <div class="group">
                <input type="password" class="form-control" name="password" placeholder="Password" style="display:none;">
                {!! Form::input('password','password',null,['class'=>'form-control','placeholder'=>'Парола']) !!}
                <i class="fa fa-key"></i>
            </div>
            <button type="submit" class="btn btn-default btn-block">ВХОД</button>
        </div>
    {!! Form::close()  !!}
    <div class="footer-links row">
        <div class="col-xs-6"><a href="#"><!--<i class="fa fa-external-link"></i> Register Now</a>--></div>
        <div class="col-xs-6 text-right"><a href="#"><i class="fa fa-lock"></i> Забравена парола</a></div>
    </div>
    @if (Session::has('message'))
        <div class="alert alert-danger">
            <strong>Ооопс!</strong> Имаше някои проблеми с паролата.<br><br>
            <ul>

                    <li>{{ Session::get('message') }}</li>

            </ul>
        </div>
    @endif
</div>

</body>
</html>