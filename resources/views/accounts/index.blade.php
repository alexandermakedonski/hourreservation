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

    <div class="col-md-13">
        <h4>List with Image</h4>
        <!-- Start Teammates -->
        <div class="panel widget panel-widget">
            <div class="panel-title">
                Служители
            </div>
            <div class="panel-body">
                <ul class="basic-list image-list">
                    <li><img src="img/profileimg.png" alt="img" class="img"><b>Jonathan Doe</b><span class="desc">Designer</span></li>
                    <li><img src="img/profileimg2.png" alt="img" class="img"><b>Egemem Ka</b><span class="desc">Front-End Developer</span></li>
                    <li><img src="img/profileimg3.png" alt="img" class="img"><b>Timmy Jefsin</b><span class="desc">Back-End Developer</span></li>
                    <li><img src="img/profileimg4.png" alt="img" class="img"><b>James K. Throwing</b><span class="desc">Marketing</span></li>
                    <li><img src="img/profileimg5.png" alt="img" class="img"><b>John Doe</b><span class="desc">iOS Developer</span></li>
                </ul>
            </div>
        </div>
        <!-- End Teammates -->
    </div>


    <div class="panel panel-default">

        <div class="panel-title">
            Служители
        </div>

        <div class="panel-body">

            <table class="table">
                <thead>
                <tr>
                    <td>Снимка</td>
                    <td>Име</td>
                    <td>Длъжност</td>
                    <td>Време</td>
                    <td>Права</td>
                    <td>Отчет</td>
                    <td>История</td>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                <tr class="info">
                    <td ><div class="list-image"><img src="/users/accounts/{{$user->profile_picture}}" alt="img" class="img"></div></td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->roles[0]->name }}</td>
                    <td>{{ $user->created_at->diffForHumans() }}</td>
                    <td>As we got further and further away, it [the Earth] diminished in size.</td>
                    <td>Credit Card</td>
                    <td>Бутон</td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>

@endsection