<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <!-- Styles -->
    <style>
        html,
        body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }
    </style>
    @include('layouts.style')
    @include('layouts.start-script')
</head>

<body>
    @if (Auth::check())
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
            data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
            @include('layouts.header')
            @include('layouts.left-menu')
            <div class="page-wrapper">
                @yield('content')
            </div>
            @include('layouts.footer')
        </div>
        <script>
            var baseURL = "{{ asset('') }}";
            $(".editor").each(function(index, el) {
                CKEDITOR.replace(this.id, {
                    baseHref: baseURL,
                    filebrowserImageBrowseUrl: baseURL + "assets/lib/ckfinder/ckfinder.html",
                    filebrowserImageBrowseUrl: baseURL + "assets/lib/ckfinder/ckfinder.html?type=Images",
                    filebrowserWindowWidth: "1000",
                    filebrowserWindowHeight: "700"
                });
            });
        </script>
    @else
        @yield('content')
    @endif
    @include('layouts.script')
    @if (\Session::has('success'))
        <script>
            showMessOk("{{ \Session::get('success') }}", "success");
        </script>
    @endif
    @if (\Session::has('error'))
        <script>
            showMessOk("{{ \Session::get('error') }}", "warning")
        </script>
    @endif
</body>

</html>
