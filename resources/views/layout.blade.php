<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? env('APP_NAME') }}</title>
    <link rel="icon" href="{{ url('/img/favicon.svg') }}">
    <link rel="manifest" href="/manifest.json" />

    <script>
        if (navigator && navigator.serviceWorker) {
            navigator.serviceWorker.register('/sw.js');
        }
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="loader" id="loader">
        <div class="spinner"></div>
    </div>
    <input type="hidden" id="user-id" value="{{ auth()->user() }}">
    @yield('content')
    <script src="https://js.pusher.com/7.0.3/pusher.min.js"></script>
    <script src="{{ url('/js/app.js') }}"></script>
    @if (session()->has('success'))
        <script type="text/javascript">
            success('{{ session()->get('success') }}');
        </script>
    @endif
</body>

</html>
