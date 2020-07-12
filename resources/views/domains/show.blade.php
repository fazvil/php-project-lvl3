@extends('layouts.app')

@include('flash::message')

@section('container')
    <div class="full-height">
    <h2> Site: {{ $domain->name }}</h2>
        <table>
            @foreach ($domain as $key => $value)
                <tr>
                    <td> {{ $key }} </td>
                    <td> {{ $value }} </td>
                </tr>
            @endforeach
        </table>
        <h3>Checks</h3>
        <form action="{{ route('domains.checks', ['id' => $domain->id]) }}" method="POST">
            @csrf
            <input class="button" type="submit" value="Run check">
        </form>
        <table class="check">
            @foreach ($checks as $item)
                <tr>
                    <td>
                        {{ $item->id }}
                    </td>
                    <td>
                        {{ $item->status_code }}
                    </td>
                    <td width="180">
                        {{ $item->created_at }}
                    </td>
                    <td width="180">
                        {{ $item->h1 }}
                    </td>
                    <td>
                        {{ $item->keywords }}
                    </td>
                    <td>
                        {{ $item->description }}
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection