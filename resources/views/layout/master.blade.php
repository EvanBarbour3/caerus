<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Test') }}</title>

    <!-- Styles -->
    <link href="{{ mix('css/main.css') }}" rel="stylesheet">
    @yield('styles')
</head>
<body>
    @yield('page')

    <!-- Stop vue kicking off (Cannot read property 'csrfToken' of undefined) -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
            'api_token' => (Auth::user() ? Auth::user()->api_token : '')
        ]); ?>
    </script>
    @stack('scripts')
    <script src="{{ mix('js/main.js') }}"></script>
</body>
</html>
