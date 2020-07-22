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
            @foreach ($domains as $domain)
                <tr> 
                    <td>
                        {{ $domain->id }}
                    </td>
                    <td>
                        <a href="{{ route('domains.show', ['id' => $domain->id]) }}">{{ $domain->name }}</a>
                    </td>
                    <td>
                        {{ $lastChecks[$domain->id]->created_at ?? '' }}
                    </td>
                    <td>
                        {{ $lastChecks[$domain->id]->status_code ?? '' }}
                    </td>
                </tr>
            @endforeach
        </table>    
    </div>
@endsection