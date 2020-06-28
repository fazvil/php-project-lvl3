<html>
<a href="/">Главная</a>
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
</html>