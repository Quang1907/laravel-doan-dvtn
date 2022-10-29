<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset( 'css/client.css' ) }}">
    <link rel="stylesheet" href="{{ asset( 'js/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset( 'css/bulma.min.css' ) }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/dist/css/index.min.css" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield( 'styles' )

</head>

<body>

    @include('layouts.inc.client.header')
    @yield('content')
    @include('layouts.inc.client.footer')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
        integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/index.min.js"></script>
    <script src="{{ asset( 'js/slick/slick.min.js') }}"></script>
    <script src="{{ asset( 'js/instafeed/instafeed.min.js' ) }}"></script>
    @include('sweetalert::alert')

    <script>
        $("#button-nav").click( function () {
            $("#mega-menu-full").toggle();
        });

        $("#mega-menu-full-dropdown").toggle();

        $("#mega-menu-full-dropdown-button").click( function () {
            $("#mega-menu-full-dropdown").toggle();
        })

        // open profile user
        $(document).ready(function() {
            var check = true;
            $("#user-dropdown").hide();
            $("#profileUser").click(
                function( ) {
                    if ( check ) {
                        $("#user-dropdown").show();
                    } else {
                        $("#user-dropdown").hide();
                    }
                    check = !check;
                }
            )
        })
    </script>

    @yield( 'script' )

</body>
</html>
