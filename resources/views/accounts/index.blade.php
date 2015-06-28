@extends('app')

@section('content')
    <!-- Start Page Header -->
    <div class="page-header">
        <div class="row">
            <div class="col-lg-1">
                <h1 class="title">Акаунти</h1>
            </div>
            <div class="col-lg-3">
                <div class="title">
                    {!! Form::open(['data-searchuser','method'=>'get','url'=>'accounts/usersearch/']) !!}
                        <div class="input-group">
                            {!! Form::text('search_query',null,['class' => 'form-control input-sm','placeholder'=>'Търси']) !!}
                            <span class="input-group-btn">
                                <button class="btn btn-light btn-sm user-search" type="button"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>

        </div>
        <ol class="breadcrumb">
            <li class="active">Форма достъпна само за администратори - за добвяне и коригиране на акаунти</li>

        </ol>
    </div>
    <!-- End Page Header -->
    <div class="row btndiv">
        <div class="col-md-12">
            <div class="ajax-users-load">

            </div>
            <div class="row">
                <div class="col-md-12 col-lg-6 registration-form">
                    @include('auth.register')
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $.ajax({
                url: '/accounts/accounts/?page='+1,
                type: "GET", // not POST, laravel won't allow it
                success: function(data){
                    $data = $(data); // the HTML content your controller has produced
                    $('.ajax-users-load').html($data);
                    $( ".page-users").first().parent().addClass('active');
                }
            });

            $('.user-search').on('click',function(){
                var form = $(this).closest('form');
                $.ajax({
                    url:form.prop('action'),
                    type:'GET',
                    data:form.serialize(),
                    success:function(data){
                        $data = $(data); // the HTML content your controller has produced
                        $('.ajax-users-load').html($data);
                        $( ".page-users-search").first().parent().addClass('active');
                    }
                });
            });



            $('input[name="search_query"]').keyup(function(e) {
                var value = this.value.length;
                if(value == 0 && e.keyCode == 8){
                    $.ajax({
                        url: '/accounts/accounts/?page='+1,
                        type: "GET", // not POST, laravel won't allow it
                        success: function(data){
                            $data = $(data); // the HTML content your controller has produced
                            $('.ajax-users-load').html($data);
                            $( ".page-users").first().parent().addClass('active');
                        }
                    });
                }
            });

            $("form[data-searchuser]").on("submit", function(e){
                    $.ajax({
                        url: $(this).prop('action'),
                        type: 'GET',
                        data: $(this).serialize(),
                        success: function (data) {
                            $data = $(data); // the HTML content your controller has produced
                            $('.ajax-users-load').html($data);
                            $(".page-users-search").first().parent().addClass('active');
                        }
                    });
                e.preventDefault();
            });
        });
    </script>
    <script type="text/javascript" src="{{ URL::to('js/vendor/plupload/plupload.full.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::to('js/accountregister.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/vendor/helpers.js') }}"></script>
@endsection


