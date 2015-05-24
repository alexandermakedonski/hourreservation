<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Kode is a Premium Bootstrap Admin Template, It's responsive, clean coded and mobile friendly">
  <meta name="keywords" content="bootstrap, admin, dashboard, flat admin template, responsive," />
  <title>Студио ШИК</title>

  <!-- ========== Css Files ========== -->
   <link href="{{ asset('/css/all.css') }}" rel="stylesheet">
  <style type="text/css">
    body{background: #F5F5F5;}
  </style>
  </head>
  <body>
    <div class="login-form">
        {!! Form::open(['url' => ('/auth/login')]) !!}
            <div class="top">
                <img src="/img/logoStudio.png" alt="icon" class="icon">
                <h4>Модул - запазване на часове - отчети</h4>
            </div>
            <div class="form-area">
                <div class="group">
                    {!! Form::text('email',null,['class' => 'form-control','placeholder' => 'Имейл']) !!}
                    <i class="fa fa-user"></i>
                </div>
                <div class="group">
                    {!! Form::password('password',['class' => 'form-control','placeholder' => 'Парола']) !!}
                    <i class="fa fa-key"></i>
                </div>
                <div class="checkbox checkbox-primary">
                    {!! Form::checkbox(null,null,null,['id' => 'checkbox101','checked']) !!}
                    <label for="checkbox101"> Запомни ме</label>
                </div>
                <button type="submit" class="btn btn-default btn-block">LOGIN</button>
            </div>
        {!! Form::close() !!}
        <div class="footer-links row">
            <div class="col-xs-6"></div>
            <div class="col-xs-6 text-right"><a href="#"><i class="fa fa-lock"></i> Забравена парола</a></div>
        </div>
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Уупс!</strong> Има проблем.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>


</body>
</html>
