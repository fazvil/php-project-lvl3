<html>
    <head>
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<style>
    html, body {
        background-color: #fff;
        color: #636b6f;
        font-family: 'Nunito', sans-serif;
        font-weight: 200;
        height: 100vh;
        margin: 0;
        font-size: 20px;
    }
    table {
        font-size: 20px;
        background-color: #fff;
        color: #636b6f;
        font-family: 'Nunito', sans-serif;
        font-weight: 200;
    }
</style>
    </head>
    <body>
@include('flash::message')
<a href="/">Главная</a>
<a href="/domains">Список доменов</a>
    <h1> Site: {{ $user->name }}</h1>
    <table>
        @foreach ($user as $key => $value)
            <tr>
                <td>
                    {{ $key }}
                </td>
                <td>
                    {{ $value }}
                </td>
            </tr>
        @endforeach
    </table>
    </body>
</html>