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