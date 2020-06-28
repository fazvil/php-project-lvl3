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

        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 100vh;
                height: 100vh;
                margin: 0;
                font-size: 20px;
            }

            .full-height {
                height: 90vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 50px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .created {
                margin-left: 20px;
                font-size: 15px;
            }
        </style>
    </head>
    
    <body>
        <header>
            @php
                if ($errors->any()) {
                    flash('Not a valid url')->error();
                }
            @endphp
            @include('flash::message') 
        </header>
        <a href="/domains">Список доменов</a>

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
