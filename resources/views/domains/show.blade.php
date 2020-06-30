@include('flash::message')
<html>
    <head>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
        <link href="/css/style.css" rel="stylesheet">
    </head>
    <body>
        <header>
            <a href="{{ route('index') }}">Home</a>
            <a href="{{ route('domains.index') }}">Domains</a>
        </header>
        <h2> Site: {{ $user->name }}</h2>
        <div class="full-height">
            <table>
                @foreach ($user as $key => $value)
                    <tr>
                        <td> {{ $key }} </td>
                        <td> {{ $value }} </td>
                    </tr>
                @endforeach
            </table>
        </div>
        <footer>
            <div class="created">
                created by Vildan Fazlyev
            </div>
        </footer>
    </body>
</html>