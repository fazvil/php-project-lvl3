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
        <link href="{{ asset('/css/style.css') }}" type="text/css" rel="stylesheet">
    </head>
    
    <body>
        @php
            if ($errors->any()) {
                flash('Not a valid url')->error();
            }
        @endphp
        @include('flash::message') 
        <header>
            <a href="/">Home</a>
            <a href="/domains">Domains</a>
        </header>

        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title">
                    Page Analyzer
                </div>
                <p class="lead">Check web pages for free</p>
                <div>
                    <form action="/domains" method="POST">
                        @csrf
                        <input type="text" name="domain" placeholder="http://www.google.com">
                        <input type="submit" value="CHECK">
                    </form>
                </div>
            </div>
        </div>
        <footer>
            <div class="created">
                created by Vildan Fazlyev
            </div>
        </footer>
    </body>
</html>
