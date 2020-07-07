<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Page Analyzer</title>

        <!-- Fonts -->
        <link href="//fonts.gstatic.com" rel="dns-prefetch">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <link rel="stylesheet" href="/css/style.css">
    </head>
    <body>
        @section('sidebar')
            <header>
                <a class="links" href="{{ route('index') }}">Home</a>
                <a href="{{ route('domains.index') }}">Domains</a>
            </header>
        @show

        @yield('container')

        @section('footer')
            <footer>
                <div>
                    created by Vildan Fazlyev
                </div>
            </footer>
        @show
    </body>
</html>