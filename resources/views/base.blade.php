<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SSCN Kabupaten Tangerang</title>
    <link rel="stylesheet" href="/kominfo/style/main.css">
</head>

<style>
    [v-cloak] {
        display: none;
    }
</style>

<body>
    <div id="kominfo">
        <v-app v-cloak>
            @yield('apps')
        </v-app>
    </div>
    
    <noscript>
        <strong>We're sorry but master doesn't work properly without JavaScript enabled. Please enable it to continue.</strong>
    </noscript>
    <script src="/kominfo/script/manifest.js"></script>
    <script src="/kominfo/script/vendor.js"></script>
    <script src="/kominfo/script/main.js"></script>
</body>
</html>