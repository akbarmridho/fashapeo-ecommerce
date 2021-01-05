<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />
        <meta http-equiv="x-ua-compatible" content="ie=edge" />
        <title>@yield('title')</title>

        <link rel="icon" href="/img/thinsquare.png" type="image/x-icon" />
        <link
            rel="stylesheet"
            href="https://use.fontawesome.com/releases/v5.11.2/css/all.css"
        />
        <link
            rel="stylesheet"
            href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap"
        />
        <link rel="stylesheet" href="{{ asset('/css/mdb.min.css') }}" />
        @yield('child-sheet')
        @yield('additional-sheet')

        <script src="{{ asset('/js/mdb.min.js') }}" defer></script>
        <script src="{{ mix('js/app.js') }}" defer></script>
        @yield('child-script')
        @yield('additional-script')
    </head>

    <body>
        @yield('child-layout')
    </body>
   
</html>