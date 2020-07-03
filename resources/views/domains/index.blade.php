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
        <div class="full-height">
            <table>
                <tr>
                    <td class="columnId">ID</td>
                    <td class="columnId">Name</td>
                    <td class="columnId">Last check</td>
                    <td class="columnId">Status Code</td>
                </tr>
                @foreach ($domains as $item)
                    <tr>
                        <td>
                            {{ $item->id }}
                        </td>
                        <td>
                            <a href="{{ route('domains.show', ['id' => $item->id]) }}">{{ $item->name }}</a>
                        </td>
                        <td>
                            @isset($lastChecks[$item->id])
                                {{ $lastChecks[$item->id] }}
                            @endisset
                        </td>
                        <td>
                            @isset($statusCode[$item->id])
                                {{ $statusCode[$item->id] }}
                            @endisset
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