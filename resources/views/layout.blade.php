<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="_token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Atkinson Media Reports -- Amy Atkinson Communications') }}</title>

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    {{-- <link rel="stylesheet" href="/css/foundation.css"> --}}
    <link rel="stylesheet" href="/css/semantic.css">
    <link rel="stylesheet" href="/js/jquery-ui-1.12.1.custom/jquery-ui.css">
    {{-- <link rel="stylesheet" href="/css/app.css"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/SocialIcons/1.0.1/soc.min.css" />

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>

    <style type="text/css" media="screen">
        .aac_med_img{
            height: 200px !important;
            object-fit: cover;
        }
    </style>

    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="/manifest.json">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="theme-color" content="#ffffff">

</head>
<body>

        <div class="ui sidebar inverted vertical menu">
            <a href='/stories' class="item">Mentions</a>
            <a href='/projects' class="item">Projects</a>
            <a href='/media' class="item">Media</a>
            {{-- @if ( Auth::user()->hasRole('siteadmin') )
                <a href="/clients" class="item">Clients</a>
            @endif --}}
        </div>
        <div class="pusher">
            <div class="topbar">
                <div class="ui container">
                    <div class="ui grid">
                        <div class="row">
                            <div class="four wide column">
                                <img class="ui medium image" src="http://res.cloudinary.com/brannanatkinson/image/upload/v1529866795/AAC/aacom_noservices_white.png" alt="">
                            </div>
                            <div class="tablet mobile only twelve wide column">
                                <div class="ui text menu">
                                    <a id="mobile_item" class="ui right item"><i class="bars icon"></i></a>
                                </div>
                            </div>
                            <div class="twelve wide computer only column">
                                <div class="ui text menu">
                                    @if ( Auth::check() )
                                        @if (Auth::user()->login_link == 1)
                                            <div class="ui right item"><a href='/stories'>Mentions</a></div>
                                            <div class="ui right item"><a href="/projects">Projects</a></div>
                                            <div class="ui right item"><a href="/media">Media</a></div>
                                            {{-- admin cog menu --}}
                                            @if ( Auth::user()->hasRole('siteadmin') )
                                                <div class="ui right item"><a href="/clients">Clients</a></div>
                                                <div class="ui right dropdown item">
                                                    <i class=" cogs large icon"></i>
                                                    <div class="menu">
                                                        <div class="header">Mentions</div>
                                                        <a href='/stories/create' class="item">Add New Mention</a >
                                                        <div class="header">Clients</div>
                                                        <a href='/admin/clients' class="item">All Clients</a>
                                                        <a href='/admin/clients/new' class="item">Add New Client</a >
                                                        <div class="header">Users</div>
                                                        <a href='/admin/users' class="item">All Users</a>
                                                        <a href='/admin/users/new' class="item">Add New User</a >
                                                        <div class="header">Account</div>
                                                        <a href='/logout' class="item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                                        <form id="logout-form" action="https://newmedia.dev/logout" method="POST" style="display: none;"><input type="hidden" name="_token" value="13woX1Yf0bEQTm0k9OzF7X4mef6CYDnvmrKFnvCB"></form>
                                                    </div>
                                                </div>
                                            @endif
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                        
                        {{-- <div class="right menu tablet mobile only">
                            <div class="ui menu">
                <a id="mobile_item" class="item"><i class="bars icon"></i></a>
                        </div> --}}

                </div>
            </div>
            <div class="ui container">
                
                @yield('content')
            </div>
        </div>
        </div>

    <!-- Scripts -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    {{-- <script src="/js/semantic.js"></script> --}}
    <script src="/js/jquery-ui-1.12.1.custom/jquery-ui.js"></script>
    <script src="/js/all.js"></script>
    {{-- <script src="/js/foundation-min.js"></script> --}}
    <script src="/js/tld.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/SocialIcons/1.0.1/soc.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.ui.checkbox')
                .checkbox()
            ;
            $('.ui.sidebar')
                .sidebar()
            ;
            $('#mobile_item').click(function(){
                $('.ui.sidebar')
                    .sidebar('toggle');
                ;
            });
            // $( "#datestart" ).datepicker();
            // $( "#dateend" ).datepicker();
            // $( "#story_date" ).datepicker();
            // $('.ui.checkbox').checkbox();
            // $('.ui.dropdown').dropdown();
            
        });
    </script>

    <script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#ogImage')
                    .attr('src', e.target.result)
                    .width(600);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    </script>
    

    <script>
        
        //$(document).foundation();
    </script>
    
</body>
</html>
