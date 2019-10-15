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
        <link href="https://fonts.googleapis.com/css?family=Merriweather|Roboto&display=swap" rel="stylesheet">

        <!-- Icons -->
        <link rel="stylesheet" href="//l.allcdn.org/fa/v5.3.1/css/all.min.css">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <!-- Favicon -->
        <link rel="shortcut icon" type="image/png" href="images/favicon.ico"/>

    </head>
    <body>

        <div id="app">

            <app
                @if(auth()->user())
                    :user-name='@json(auth()->user()->name)'
                    :user-id='@json(auth()->user()->id)'
                @endif
            ></app>

        </div>

        <script src="{{ asset('js/app.js') }}"></script>

    </body>

</html>
