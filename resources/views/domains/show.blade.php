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
        <h2> Site: {{ $entity->name }}</h2>
        <div class="full-height">
            <table>
                @foreach ($entity as $key => $value)
                    <tr>
                        <td> {{ $key }} </td>
                        <td> {{ $value }} </td>
                    </tr>
                @endforeach
            </table>
            <h3>Checks</h3>
            <form action="{{ route('domains.checks', ['id' => $entity->id]) }}" method="POST">
                @csrf
                <input class="button" type="submit" value="Run check">
            </form>
            <div>
            <table>
                @foreach ($checks as $item)
                    <tr>
                        <td>
                            {{ $item->status_code }}
                        </td>
                        <td>
                            {{ $item->created_at }}
                        </td>
                    </tr>
                @endforeach
            </table>
            </div>
        </div>
        <footer>
            <div class="created">
                created by Vildan Fazlyev
            </div>
        </footer>
    </body>
</html>