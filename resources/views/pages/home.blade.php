@extends('app')

@section('styles')
    <link href="{{ asset('/css/plugin/qtip/jquery.qtip.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/plugin/fullcalendar/fullcalendar.css') }}" rel="stylesheet">
    <style>
        #calendar {
            max-width: 900px;
            margin: 40px auto;
            padding: 0 10px;
        }
        .dropdown-menu li{
            cursor: pointer;
        }
    </style>
@endsection

@section('content')
    <!-- Start Page Header -->
    <div class="page-header">
        <h1 class="title">Табло</h1>
        <ol class="breadcrumb">
            <li class="active">Добре дошли.</li>
        </ol>
    </div>
    <!-- End Page Header -->
    <div class="panel">
        <div class="row btndiv">
            {{--<div class="col-md-3">--}}
                {{--<div class="dropdown">--}}
                    {{--<input type="text"  class="form-control searchEvent" data-toggle="dropdown" >--}}
                    {{--<ul class="dropdown-menu">--}}
                        {{--<li>&nbsp&nbsp&nbspНяма намерени резутлати!&nbsp&nbsp&nbsp</li>--}}
                    {{--</ul>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div id='external-events'>--}}
            {{--<h4>Draggable Events</h4>--}}
            {{--<div class='draggable' data-title="Подстригване" data-description="ВАЛЯ-ПЕПИ"  data-duration='05:00'>Подстригване</div>--}}
            {{--<div class='draggable' data-title="Боядисване" data-description='ДЕси-НИКИ'>Боядисване</div>--}}
            {{--</div>--}}
            <div class="col-md-8">
                <div id='calendar'></div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="hourElements" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="dropdown">
                            <label for="recipient-name" class="control-label">Услуга:</label>
                            <input type="text"  class="form-control searchEventModal" data-toggle="dropdown" >
                            <ul class="dropdown-menu">
                                <li>&nbsp&nbsp&nbspНяма намерени резутлати!&nbsp&nbsp&nbsp</li>
                            </ul>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Клиент:</label>
                        <input type="text" value='' class="form-control" id="personal">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Служител:</label>
                        <input type="text" value='' class="form-control" id="client">
                    </div>
                    <input type="text" value='' class="form-control" id="start" style="display: none">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" id="submit" data-dismiss="modal">Избери</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script type="text/javascript" src="{{ URL::asset('js/vendor/fullcalendar/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/vendor/fullcalendar/fullcalendar.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/vendor/fullcalendar/lang-all.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/vendor/qtip/imagesloaded.pkg.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/vendor/qtip/jquery.qtip.js') }}"></script>
    <script>
    $(document).ready(function() {
        var currentLangCode = 'bg';
        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            dayClick:function(date, jsEvent, view){
                $('#hourElements').modal('show');
                $('#start').val(date.format());
            },
            slotEventOverlap:true,
            defaultDate: $('#calendar').fullCalendar( 'today' ),
            lang: currentLangCode,
            defaultView: 'agendaWeek',
            buttonIcons: false, // show the prev/next text
            weekNumbers: true,
            editable: true,
            eventLimit: true, // allow "more" link when too many events
            events: [
                    {
                        title: 'Meeting',
                        description: 'Description',
                        start: '2015-06-29T14:30:00',
                    }

            ],
            editable:false,
            drop: function(date) {
            },
            droppable: true,
            eventRender: function(event, element) {
                element.qtip({
                    content: event.description,
                    position: {
                        my: 'bottom center',
                        at: 'top center'
                    },
                    style: {
                        classes: 'myQtip'
                    }
                });
                console.log();
            },
            eventClick: function(event, element) {

                console.log(event);
                //$('#calendar').fullCalendar('removeEvents', event._id);

            }

        });

        function dynamicElements(){

            $('.draggable').each(function(){
                $(this).data('event', {
                    title: $.trim($(this).text()), // use the element's text as the event title
                    stick: true // maintain when user navigates (see docs on the renderEvent method)
                });
                $(this).draggable({
                    zIndex: 999,
                    revert: true,      // will cause the event to go back to its
                    revertDuration: 0  //  original position after the drag
                });

                $(this).data('event', { 'title': $(this).data('title'),'description': $(this).data('description') });
            });
        }
        dynamicElements();
//            $('.addEvent').on('keyup',function(e){
//                if(e.keyCode == 13)
//                {
//                    $('#external-events').append("<div class='draggable'  data-title="+$(this).val()+" data-description='Dynamic'  data-duration='00:30'>"+$(this).val()+"</div>");
//                    dynamicElements();
//                }
//
//            });
        var services = {!! $services!!};
        $('.searchEvent').on('keyup',function(e){
            var searchVal = $(this).val().toLowerCase();
            if(searchVal.length > 0) {
                $('.dropdown-menu').empty();
                services.forEach(function (service) {
                    var name = service.name.toLowerCase();
                    if (name.search(searchVal) > -1) { //data-description="price:'+service.price+',time:'+service.time+' data-duration='+service.time+'
                        $('.dropdown-menu').append('<li class="draggable" data-title="' + service.name + '" data-description=price:"' + service.price + '"/time:"' + service.time + '" data-duration="' + service.time + '">&nbsp&nbsp&nbsp"' + service.name + '"</li>');
                    }
                });
                dynamicElements();
            }else{
                $('.dropdown-menu').empty().append('<li>&nbsp&nbsp&nbspНяма намерени резутлати!&nbsp&nbsp&nbsp</li>');

            }
        });


        $('.searchEventModal').on('keyup',function(e){
            var searchVal = $(this).val().toLowerCase();
            if(searchVal.length > 0) {
                $('.dropdown-menu').empty();
                services.forEach(function (service) {
                    var name = service.name.toLowerCase();
                    if (name.search(searchVal) > -1) {
                        $('.dropdown-menu').append('<li data-service data-title="' + service.name + '" data-description=price:"' + service.price + '"/time:"' + service.time + '" data-duration="' + service.time + '">&nbsp&nbsp&nbsp"' + service.name + '"</li>');
                    }
                });
                dynamicElements();
            }else{
                $('.dropdown-menu').empty().append('<li>&nbsp&nbsp&nbspНяма намерени резутлати!&nbsp&nbsp&nbsp</li>');
            }

            $("li[data-service]").on("click", function(){

                $('.searchEventModal').val($(this).data('title'));
                $('.searchEventModal').data('title',$(this).data('title')) ;
                $('.searchEventModal').data('description',$(this).data('description')) ;
                $('.searchEventModal').data('duration',$(this).data('duration'));

            });

        });

        $('#submit').on('click',function(e){
            var a = moment.duration($('.searchEventModal').data('duration'),'m');
            var end = moment($('#start').val());
            end.add(a, 'milliseconds');

            $("#calendar").fullCalendar('renderEvent',
            {
                title: $('.searchEventModal').data('title'),
                description: $('.searchEventModal').data('description')+'/'+$('#client').val()+'/'+$('#personal').val(),
                start: $('#start').val(),
                end:end
        }, true);
            $('.searchEventModal').val('');
            $('#client').val('');
            $('#personal').val('');
        });
     });
    </script>
    <script type="text/javascript" src="{{ URL::asset('js/vendor/helpers.js') }}"></script>
@endsection