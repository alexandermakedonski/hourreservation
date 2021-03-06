<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Студио шик модул">
    <meta name="keywords" content=студио,шик,запазване,час,отчети"/>
    <title>Студио ШИК запазване на час</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('/img/favicons/favicon.ico') }}">

    <!-- ========== Css Files ========== -->
    <link href="{{ asset('/css/all.css') }}" rel="stylesheet">
    @yield('styles')

</head>
<body>
<!-- Start Page Loading -->
<div class="loading"><img src="{{ asset('img/loading.gif') }}" alt="loading-img"></div>
<!-- End Page Loading -->
<!-- //////////////////////////////////////////////////////////////////////////// -->
<!-- START TOP -->
<div id="top" class="clearfix">

    <!-- Start App Logo -->
    <div class="applogo">
        <a href="{{ URL::to('/') }}" class="logo">Студио ШИК</a>
    </div>
    <!-- End App Logo -->

    <!-- Start Sidebar Show Hide Button -->
    <a href="#" class="sidebar-open-button"><i class="fa fa-bars"></i></a>
    <a href="#" class="sidebar-open-button-mobile"><i class="fa fa-bars"></i></a>
    <!-- End Sidebar Show Hide Button -->

    <!-- Start Searchbox -->
    {{--<form class="searchform">--}}
    {{--<input type="text" class="searchbox" id="searchbox" placeholder="Search">--}}
    {{--<span class="searchbutton"><i class="fa fa-search"></i></span>--}}
    {{--</form>--}}
    <!-- End Searchbox -->

    <!-- Start Top Menu -->
    {{--<ul class="topmenu">--}}
    {{--<li><a href="#">Files</a></li>--}}
    {{--<li><a href="#">Authors</a></li>--}}
    {{--<li class="dropdown">--}}
    {{--<a href="#" data-toggle="dropdown" class="dropdown-toggle">My Files <span class="caret"></span></a>--}}
    {{--<ul class="dropdown-menu">--}}
    {{--<li><a href="#">Videos</a></li>--}}
    {{--<li><a href="#">Pictures</a></li>--}}
    {{--<li><a href="#">Blog Posts</a></li>--}}
    {{--</ul>--}}
    {{--</li>--}}
    {{--</ul>--}}
    {{--<!-- End Top Menu -->--}}

    <!-- Start Sidepanel Show-Hide Button -->
    <a href="javascript:void(0)" class="sidepanel-open-button"><i class="fa fa-outdent"></i></a>
    <!-- End Sidepanel Show-Hide Button -->

    <!-- Start Top Right -->
    <ul class="top-right">

        <li class="dropdown link">
            <a href="#" data-toggle="dropdown" class="dropdown-toggle hdbutton">Create New <span
                        class="caret"></span></a>
            <ul class="dropdown-menu dropdown-menu-list">
                <li><a href="#"><i class="fa falist fa-paper-plane-o"></i>Product or Item</a></li>
                <li><a href="#"><i class="fa falist fa-font"></i>Blog Post</a></li>
                <li><a href="#"><i class="fa falist fa-file-image-o"></i>Image Gallery</a></li>
                <li><a href="#"><i class="fa falist fa-file-video-o"></i>Video Gallery</a></li>
            </ul>
        </li>


        <li class="dropdown link">
            <a href="#" data-toggle="dropdown" class="dropdown-toggle profilebox">

                <img src="/avatar/{{ \Hashids::encode(Auth::user()->id,rand(0,100)) }}" alt="img">

                <b>{{Auth::user()->name}}</b><span class="caret"></span></a>
            <ul class="dropdown-menu dropdown-menu-list dropdown-menu-right">
                <li role="presentation" class="dropdown-header">Profile</li>
                <li><a href="#"><i class="fa falist fa-inbox"></i>Inbox<span class="badge label-danger">4</span></a>
                </li>
                <li><a href="#"><i class="fa falist fa-file-o"></i>Files</a></li>
                <li><a href="#"><i class="fa falist fa-wrench"></i>Settings</a></li>
                <li class="divider"></li>
                <li><a href="{{ URL::to('/lock') }}"><i class="fa falist fa-lock"></i> Lockscreen</a></li>
                <li><a href="{{ URL::to('/auth/logout') }}"><i class="fa falist fa-power-off"></i> Logout</a></li>
            </ul>
        </li>

    </ul>
    <!-- End Top Right -->

</div>
<!-- END TOP -->
<!-- //////////////////////////////////////////////////////////////////////////// -->

<!-- //////////////////////////////////////////////////////////////////////////// -->
<!-- START SIDEBAR -->
<div class="sidebar sidebar-colorful clearfix">

    <ul class="sidebar-panel nav">
        <li class="sidetitle">Меню</li>
        @if(Auth::user()->roles[0]->name == 'Administrator')
            <li><a href="{{ URL::to('/accounts') }}"><span class="icon color5"><i class="fa fa-home"></i></span>Акаунти<span class="label label-default"></span></a></li>
            <li><a href="mailbox.html"><span class="icon color6"><i class="fa fa-bar-chart"></i></span>Отчети<span class="label label-default"></span></a></li>
        @endif
        <li><a href="#"><span class="icon color7"><i class="fa fa-clock-o"></i></span>Часове<span class="caret"></span></a>
            <ul>
                <li><a href="icons.html">Запазване на часове</a></li>
                <li><a href="tabs.html">Корекция на часове</a></li>
            </ul>
        </li>
    </ul>

    <div class="sidebar-plan">
        Pro Plan<a href="#" class="link">Upgrade</a>

        <div class="progress">
            <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
                 style="width: 60%;">
            </div>
        </div>
        <span class="space">42 GB / 100 GB</span>
    </div>

</div>
<!-- END SIDEBAR -->
<!-- //////////////////////////////////////////////////////////////////////////// -->

<!-- //////////////////////////////////////////////////////////////////////////// -->
<!-- START CONTENT -->
<div class="content">




    <!-- //////////////////////////////////////////////////////////////////////////// -->
    <!-- START CONTAINER -->

    @yield('content')
    <div class="container-default"></div>

    <!-- END CONTAINER -->
    <!-- //////////////////////////////////////////////////////////////////////////// -->

    <!-- Flash Message -->
    <div class="flash"></div>

    <!-- Start Footer -->
    <div class="row footer">
        <div class="col-md-6 text-left">
            Copyright © 2015 Alexander Makedonski All
            rights reserved.
        </div>
        <div class="col-md-6 text-right">
            Design and Developed by Alexandre Makedonski
        </div>
    </div>
    <!-- End Footer -->



</div>
<!-- End Content -->
<!-- //////////////////////////////////////////////////////////////////////////// -->

<!-- //////////////////////////////////////////////////////////////////////////// -->
<!-- START SIDEPANEL -->
<div role="tabpanel" class="sidepanel">

    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#today" aria-controls="today" role="tab"
                                                  data-toggle="tab">TODAY</a></li>
        <li role="presentation"><a href="#tasks" aria-controls="tasks" role="tab" data-toggle="tab">TASKS</a></li>
        <li role="presentation"><a href="#chat" aria-controls="chat" role="tab" data-toggle="tab">CHAT</a></li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">

        <!-- Start Today -->
        <div role="tabpanel" class="tab-pane active" id="today">

            <div class="sidepanel-m-title">
                Today
                <span class="left-icon"><a href="#"><i class="fa fa-refresh"></i></a></span>
                <span class="right-icon"><a href="#"><i class="fa fa-file-o"></i></a></span>
            </div>

            <div class="gn-title">NEW</div>

            <ul class="list-w-title">
                <li>
                    <a href="#">
                        <span class="label label-danger">ORDER</span>
                        <span class="date">9 hours ago</span>
                        <h4>New Jacket 2.0</h4>
                        Etiam auctor porta augue sit amet facilisis. Sed libero nisi, scelerisque.
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="label label-success">COMMENT</span>
                        <span class="date">14 hours ago</span>
                        <h4>Bill Jackson</h4>
                        Etiam auctor porta augue sit amet facilisis. Sed libero nisi, scelerisque.
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="label label-info">MEETING</span>
                        <span class="date">at 2:30 PM</span>
                        <h4>Developer Team</h4>
                        Etiam auctor porta augue sit amet facilisis. Sed libero nisi, scelerisque.
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="label label-warning">EVENT</span>
                        <span class="date">3 days left</span>
                        <h4>Birthday Party</h4>
                        Etiam auctor porta augue sit amet facilisis. Sed libero nisi, scelerisque.
                    </a>
                </li>
            </ul>

        </div>
        <!-- End Today -->

        <!-- Start Tasks -->
        <div role="tabpanel" class="tab-pane" id="tasks">

            <div class="sidepanel-m-title">
                To-do List
                <span class="left-icon"><a href="#"><i class="fa fa-pencil"></i></a></span>
                <span class="right-icon"><a href="#"><i class="fa fa-trash"></i></a></span>
            </div>

            <div class="gn-title">TODAY</div>

            <ul class="todo-list">
                <li class="checkbox checkbox-primary">
                    <input id="checkboxside1" type="checkbox"><label for="checkboxside1">Add new products</label>
                </li>

                <li class="checkbox checkbox-primary">
                    <input id="checkboxside2" type="checkbox"><label for="checkboxside2"><b>May 12, 6:30 pm</b> Meeting
                        with Team</label>
                </li>

                <li class="checkbox checkbox-warning">
                    <input id="checkboxside3" type="checkbox"><label for="checkboxside3">Design Facebook page</label>
                </li>

                <li class="checkbox checkbox-info">
                    <input id="checkboxside4" type="checkbox"><label for="checkboxside4">Send Invoice to
                        customers</label>
                </li>

                <li class="checkbox checkbox-danger">
                    <input id="checkboxside5" type="checkbox"><label for="checkboxside5">Meeting with developer
                        team</label>
                </li>
            </ul>

            <div class="gn-title">TOMORROW</div>
            <ul class="todo-list">
                <li class="checkbox checkbox-warning">
                    <input id="checkboxside6" type="checkbox"><label for="checkboxside6">Redesign our company
                        blog</label>
                </li>

                <li class="checkbox checkbox-success">
                    <input id="checkboxside7" type="checkbox"><label for="checkboxside7">Finish client work</label>
                </li>

                <li class="checkbox checkbox-info">
                    <input id="checkboxside8" type="checkbox"><label for="checkboxside8">Call Johnny from Developer
                        Team</label>
                </li>

            </ul>
        </div>
        <!-- End Tasks -->

        <!-- Start Chat -->
        <div role="tabpanel" class="tab-pane" id="chat">

            <div class="sidepanel-m-title">
                Friend List
                <span class="left-icon"><a href="#"><i class="fa fa-pencil"></i></a></span>
                <span class="right-icon"><a href="#"><i class="fa fa-trash"></i></a></span>
            </div>

            <div class="gn-title">ONLINE MEMBERS (3)</div>
            <ul class="group">
                <li class="member"><a href="#"><img src="/img/profileimg.png" alt="img"><b>Allice Mingham</b>Los Angeles</a><span
                            class="status online"></span></li>
                <li class="member"><a href="#"><img src="/img/profileimg2.png" alt="img"><b>James Throwing</b>Las
                        Vegas</a><span class="status busy"></span></li>
                <li class="member"><a href="#"><img src="/img/profileimg3.png" alt="img"><b>Fred Stonefield</b>New
                        York</a><span class="status away"></span></li>
                <li class="member"><a href="#"><img src="/img/profileimg4.png" alt="img"><b>Chris M. Johnson</b>California</a><span
                            class="status online"></span></li>
            </ul>

            <div class="gn-title">OFFLINE MEMBERS (8)</div>
            <ul class="group">
                <li class="member"><a href="#"><img src="/img/profileimg5.png" alt="img"><b>Allice Mingham</b>Los Angeles</a><span
                            class="status offline"></span></li>
                <li class="member"><a href="#"><img src="/img/profileimg6.png" alt="img"><b>James Throwing</b>Las
                        Vegas</a><span class="status offline"></span></li>
            </ul>

            <form class="search">
                <input type="text" class="form-control" placeholder="Search a Friend...">
            </form>
        </div>
        <!-- End Chat -->

    </div>

</div>
<!-- END SIDEPANEL -->
<!-- //////////////////////////////////////////////////////////////////////////// -->


<!-- ================================================
JS Library
================================================ -->
<script type="text/javascript" src="{{ URL::asset('js/all.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        Globals = {  _token : '{{csrf_token()}}' }
    });
</script>
@yield('scripts')


</body>
</html>