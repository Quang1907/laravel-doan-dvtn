<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta name="desciption" content="@yield( 'description' )">
    <meta name="keywords" content="@yield( 'keywords' )">
    <meta name="author" content="Quang CNTT">

    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset( 'css/client.css' ) }}">
    <link rel="stylesheet" href="{{ asset( 'js/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset( 'css/bulma.min.css' ) }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/dist/css/index.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.3/dist/flowbite.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.3/dist/flowbite.min.css" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield( 'styles' )
    @livewireStyles
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
    <script src="https://unpkg.com/flowbite@1.5.3/dist/flowbite.js"></script>

    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        ( function() {
            var s1 = document.createElement("script"),s0=document.getElementsByTagName("script")[0];

            s1.async=true;
            s1.src='https://embed.tawk.to/6366864bdaff0e1306d5e3a3/1gh48dkql';
            s1.charset='UTF-8';
            s1.setAttribute('crossorigin','*');
            s0.parentNode.insertBefore(s1,s0);
        })();
    </script>

    @include('sweetalert::alert')
    @yield( 'script' )

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // alert wishlist product detail
        window.addEventListener( 'message', event => {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
                })

                Toast.fire({
                icon: event.detail.type,
                title: event.detail.text
                })
            })
    </script>

    @livewireScripts

</body>
</html>
