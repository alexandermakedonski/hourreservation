@extends('app')

@section('content')
    <!-- Start Page Header -->
    <div class="page-header">
        <h1 class="title">Табло</h1>
        <ol class="breadcrumb">
            <li class="active">Добре дошли.</li>
        </ol>

        <!-- Start Page Header Right Div -->
        <div class="right">
            <div class="btn-group" role="group" aria-label="...">
                <a href="index.html" class="btn btn-light">Dashboard</a>
                <a href="#" class="btn btn-light"><i class="fa fa-refresh"></i></a>
                <a href="#" class="btn btn-light"><i class="fa fa-search"></i></a>
                <a href="#" class="btn btn-light" id="topstats"><i class="fa fa-line-chart"></i></a>
            </div>
        </div>
        <!-- End Page Header Right Div -->

    </div>
    <!-- End Page Header -->
@endsection