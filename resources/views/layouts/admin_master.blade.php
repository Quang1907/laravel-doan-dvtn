<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="{{ asset('plugins/material/css/materialdesignicons.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('plugins/simplebar/simplebar.css') }}" rel="stylesheet" />

    <!-- PLUGINS CSS STYLE -->
    <link href="{{ asset('plugins/nprogress/nprogress.css') }}" rel="stylesheet" />
    <link href="{{ asset('plugins/DataTables/DataTables-1.10.18/css/jquery.dataTables.min.css') }}"
        rel="stylesheet" />
    <link href="{{ asset('plugins/jvectormap/jquery-jvectormap-2.0.3.css') }}" rel="stylesheet" />
    <link href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}" rel="stylesheet" />
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link href="{{ asset('plugins/toaster/toastr.min.css') }}" rel="stylesheet" />

    <!-- MONO CSS -->
    <link id="main-css-href" rel="stylesheet" href="{{ asset('css/style.css') }}" />

    <!-- FAVICON -->
    <link href="{{ asset('images/favicon.png') }}" rel="shortcut icon" />
    <script src="{{ asset('plugins/nprogress/nprogress.js') }}"></script>

    {{-- Tailwind --}}
    <link rel="stylesheet" href="{{ asset( 'css/app.css' ) }}">

    @yield( 'css' )
</head>

<body class="navbar-fixed sidebar-fixed" id="body">
    <div class="wrapper">
        @include( "layouts.inc.admin.sidebar")
        <div class="page-wrapper">
            @include( "layouts.inc.admin.header" )
            @yield( "content" )
            @include( "layouts.inc.admin.footer" )
        </div>
    </div>

    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset( 'plugins/bootstrap/js/bootstrap.bundle.min.js' ) }}"></script>
    <script src="https://unpkg.com/hotkeys-js/dist/hotkeys.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('plugins/toaster/toastr.min.js') }}"></script>
    <script src="{{ asset( 'js/mono.js' ) }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"
    integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js"
        integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous">
    </script>
    <script src="https://malsup.github.io/jquery.form.js"></script>

    <script>
        $(function(){
            var href  = window.location.href;
            $('#sidebar-menu li a').each( function( ) {
                var $this = $(this);
                if( $this.attr('href') == href ) {
                    $this.css( {"background-color" : "#9e6de0", "color" : "black"} );
                }
            })
        })

        $(".sidenav-item-link").click(function(){
            $($(this).data("target")).slideToggle();
        })
    </script>
    @yield( "script" )
    @include('sweetalert::alert')
</body>

</html>
