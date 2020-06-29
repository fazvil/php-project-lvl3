<html>
    <head>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
        <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
    </head>
    <body>
        <header>
            <a href="/">Home</a>
            <a href="/domains">Domains</a>
        </header>
        <div class="full-height">
            <table>
                @foreach ($domains as $item)
                    <tr>
                        <td>
                            {{ $item->id }}
                        </td>
                        <td>
                            <a href="/domains/{{ $item->id }}">{{ $item->name }}</a>
                        </td>
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