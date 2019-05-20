<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    @yield('styles')

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
<div id="app">

    @include('partials.header')

    <main>
        <div class="container">
            @yield('content')
        </div>
    </main>

    @include('partials.footer')

</div>

<!-- Scripts -->
<script type="text/javascript">
    var user = {!! Auth::user() !!};
    var pusher_key = "{{ env('PUSHER_KEY') }}";
    var pusher_cluster = "{{ env('PUSHER_CLUSTER') }}";
</script>
<script src="{{ mix('js/app.js') }}"></script>
<script type="text/javascript">
    $("a.notification-item").sideNav({
        edge: 'right'
    });
</script>

@yield('scripts')
</body>
</html>