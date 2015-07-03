@extends('app')

@section('styles')
    <link href="{{ asset('/css/plugin/qtip/jquery.qtip.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/plugin/fullcalendar/fullcalendar.css') }}" rel="stylesheet">
    <style>
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
                    {!! Form::open(['data-user-service','method'=>'post','url'=>'calendar/service-for-users/']) !!}

                    <div class="form-group">
                        <div class="dropdown">
                            <label class="control-label">Услуга:</label>
                            <input name="service" type="text" autocomplete="off" class="form-control searchEventModal" data-toggle="dropdown" >
                            <ul class="dropdown-menu">
                                <li>&nbsp&nbsp&nbspНяма намерени резутлати!&nbsp&nbsp&nbsp</li>
                            </ul>
                        </div>
                    </div>

                    <div class="form-group">
                        <label name="personal" for="recipient-name" class="control-label">Служител:</label>
                        <select class="form-control selected-user">
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="control-label">Клиент:</label>
                        <input name="client" type="text" value='' class="form-control" id="client">
                    </div>

                    <input type="text" value='' class="form-control" id="start" style="display: none">
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-default" id="submit" >Избери</button>
                </div>
                {!! Form::close() !!}
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
            defaultDate: $('#calendar').fullCalendar( 'today' ),
            lang: currentLangCode,
            defaultView: 'agendaWeek',
            weekNumbers: true,
            editable: true,
            allDaySlot: false,
            slotDuration: '00:15:01',
            scrollTime: '10:00:00',
            minTime: "08:00:00",
            maxTime: "23:00:00",
            axisFormat: 'H:mm',
            eventLimit: true, // allow "more" link when too many events
            events: [
                @foreach($reservedhours as $reservedhour)
                    {

                            title: '{!!$reservedhour->services[0]->name!!}',
                            description: '{!!$reservedhour->description!!}',
                            start: '{!!$reservedhour->start!!}',
                            end: '{!!$reservedhour->end!!}'

                    },
                @endforeach

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

        var services = {!! $services!!};

        $('.searchEventModal').on('keyup',function(e){
            var searchVal = $(this).val().toLowerCase();
            searchVal = transliterate(searchVal);
            if(searchVal.length > 0) {
                $('.dropdown-menu').empty();
                services.forEach(function (service) {
                    var name = service.name.toLowerCase();
                    if (name.search(searchVal) > -1) {
                        $('.dropdown-menu').append('<li data-service data-id="' + service.id + '" data-title="' + service.name + '" data-description="price:' + service.price + '/time:' + service.time + '" data-duration="' + service.time + '">&nbsp&nbsp&nbsp"' + service.name + '"</li>');
                    }
                });
                dynamicElements();
            }else{
                $('.dropdown-menu').empty().append('<li>&nbsp&nbsp&nbspНяма намерени резутлати!&nbsp&nbsp&nbsp</li>');
            }

            $("li[data-service]").on("click", function(){

                var a = moment.duration($(this).data('duration'),'m');
                var end = moment($('#start').val());
                end.add(a, 'milliseconds');
                end = end.format();
                $('.searchEventModal').val($(this).data('title'));
                $('.searchEventModal').data('id',$(this).data('id'));
                $('.searchEventModal').data('title',$(this).data('title'));
                $('.searchEventModal').data('description',$(this).data('description'));
                $('.searchEventModal').data('end',end);

                $.ajax({
                    type:'GET',
                    url:'/calendar/users-for-service/',
                    data:{'id':$(this).data('id')},
                    success:function(data){
                        $('.selected-user').empty();
                        data.forEach(function(data){
                            //console.log(data);
                            $('.selected-user').append('<option data-userid="'+data.id+'">'+data.name+'</option>');
                        });
                    }
                });

            });

        });

        function transliterate(word){
            var answer = "" , a = {};

            a["A"]="А";a["a"]="а";
            a["B"]="Б";a["b"]="б";
            a["V"]="В";a["v"]="в";
            a["G"]="Г";a["g"]="г";
            a["D"]="Д";a["d"]="д";
            a["E"]="Е";a["e"]="е";
            a["J"]="Ж";a["j"]="ж";
            a["Z"]="З";a["z"]="з";
            a["I"]="И";a["i"]="и";
            a["K"]="К";a["k"]="к";
            a["L"]="Л";a["l"]="л";
            a["M"]="М";a["m"]="м";
            a["N"]="Н";a["n"]="н";
            a["O"]="О";a["o"]="о";
            a["P"]="П";a["p"]="п";
            a["R"]="Р";a["r"]="р";
            a["S"]="С";a["s"]="с";
            a["T"]="Т";a["t"]="т";
            a["U"]="У";a["u"]="у";
            a["F"]="Ф";a["f"]="ф";
            a["PH"]="Ф";a["ph"]="ф";
            a["PF"]="Ф";a["pf"]="ф";
            a["H"]="Х";a["h"]="х";
            a["TS"]="Ц";a["ts"]="ц";
            a["TZ"]="Ц";a["tz"]="ц";
            a["TCH"]="Ч";a["tch"]="ч";
            a["CH"]="Ч";a["ch"]="ч";
            a["SH"]="Ш";a["sh"]="ш";
            a["TSH"]="Ш";a["tsh"]="ш";
            a["SHT"]="Щ";a["sht"]="щ";
            a["SHT"]="Щ";a["sht"]="щ";
            a["IU"]="Ю";a["iu"]="ю";
            a["YU"]="Ю";a["yu"]="ю";
            a["IA"]="Ю";a["ia"]="ю";
            a["YA"]="Ю";a["ya"]="ю";

            a["Q"]="Я";a["q"]="я";
            a["X"]="Ь";a["x"]="х";
            a["W"]="В";a["w"]="в";
            a["Y"]="и";a["y"]="и";
            for (i in word){
                if (word.hasOwnProperty(i)) {
                    if (a[word[i]] === undefined){
                        answer += word[i];
                    } else {
                        answer += a[word[i]];
                    }
                }
            }
            return answer;
        }

        $('#submit').on('click',function(e){

            $("#calendar").fullCalendar('renderEvent',
            {
                title: $('.searchEventModal').data('title'),
                description:$('#client').val(),
                start: $('#start').val(),
                end:$('.searchEventModal').data('end')
            }, true);


            $(this).closest('form').submit();


        });

        $("form[data-user-service]").on("submit", function(e){

            $.ajax({
                type: 'POST',
                url: $(this).prop('action'),
                data: {'_token': Globals._token,'user_id': $('.selected-user option:selected').data('userid'),'service_id':$('.searchEventModal').data('id'),'description':$('#client').val(),'start':$('#start').val(),'end':$('.searchEventModal').data('end')},
                success: function (data) {
                    console.log(data);
                }
            });

            $('.searchEventModal').val('');
            $('#client').val('');
            $('#personal').val('');
            $('.selected-user').empty();

            $('#hourElements').modal('hide');

            e.preventDefault();
        });

     });
    </script>
    <script type="text/javascript" src="{{ URL::asset('js/vendor/helpers.js') }}"></script>
@endsection