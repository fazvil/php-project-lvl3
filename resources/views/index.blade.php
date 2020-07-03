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
        @php
            if ($errors->any()) {
                flash('Not a valid url')->error();
            }
        @endphp
        @include('flash::message') 
        <header>
            <a href="{{ route('index') }}">Home</a>
            <a href="{{ route('domains.index') }}">Domains</a>
        </header>

        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title">
                    Page Analyzer
                </div>
                <p class="lead">Check web pages for free</p>
                <div>
                    <form action="{{ route('domains.store') }}" method="POST">
                        @csrf
                        <input type="url" name="domain" value="" placeholder="https://www.google.com">
                        <input class="button" type="submit" value="CHECK">
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
