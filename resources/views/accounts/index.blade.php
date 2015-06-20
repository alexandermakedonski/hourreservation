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
                    $('.ajax-users-load').hide().html($data).fadeIn('100');
                    $( ".page-users").first().parent().addClass('active');
                }
            });
        });
    </script>
    <script type="text/javascript">
        $('#multiple-optgroups').multiselect({
            enableFiltering: true,
            enableClickableOptGroups: true,
            buttonWidth: '340px',
            maxHeight:720,
            onDropdownShow: function(event) {
                var bodyhegith = $('.registration-form').height();
                $('.registration-form').css({'height':bodyhegith+570+'px'});
            },
            onDropdownHidden: function(event) {
                var bodyhegith = $('.registration-form').height();
                $('.registration-form').css({'height':bodyhegith-570+'px'});
            }
        });
    </script>
    <script type="text/javascript" src="{{ URL::to('js/vendor/plupload/plupload.full.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::to('js/accountregister.js') }}"></script>
@endsection


