<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script> window.Laravel = { csrfToken: 'csrf_token() ' } </script>

        <title>Jeremy Bratcher, Web Developer</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Lalezar|Source+Sans+Pro&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    </head>
    <body>

        <div id="app">

            <app></app>

        </div>

        <script src="{{ asset('js/app.js') }}"></script>

    </body>

</html>
