@extends('layouts.app')

@section('container')
    <div class="full-height">
        <h2>Domains</h2>
        <table class="domains">
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
                        {{ $item->last_check_created_at }}
                    </td>
                    <td>
                        {{ $item->status_code }}
                    </td>
                </tr>
            @endforeach
        </table>    
    </div>
@endsection