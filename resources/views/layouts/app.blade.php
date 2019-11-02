<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{env('APP_NAME',"CHAT")}}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <style>
        html {
            height: 100%;
        }
    </style>
    <script src="{{mix('js/app.js')}}"></script>
</head>
<body class="h-full">
<div class="h-full">
    <div class="h-full">
        @yield('content')
    </div>
    @livewireAssets
</div>
</body>
</html>
