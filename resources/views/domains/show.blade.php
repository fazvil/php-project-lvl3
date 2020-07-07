@extends('layouts.app')

@include('flash::message')

@section('container')
    <div class="full-height">
    <h2> Site: {{ $entity->name }}</h2>
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
        <table>
            @foreach ($checks as $item)
                <tr>
                    <td>
                        {{ $item->id }}
                    </td>
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
@endsection