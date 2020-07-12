<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Str;
use DiDom\Document;
use GuzzleHttp\Client;

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/domains', function () {
    /*
    $latestChecks = DB::table('domain_checks')
                   ->select('domain_id', DB::raw('MAX(created_at) as last_check'))
                   ->groupBy('domain_id');
    $domains = DB::table('domains')
        ->leftJoinSub($latestChecks, 'latest_check', function ($join) {
            $join->on('domains.id', '=', 'latest_check.domain_id');
        })->get();
    */
    
    $domains = DB::table('domains')->get();

    $lastChecks = DB::table('domain_checks')->pluck('created_at', 'domain_id');
    $statusCodes = DB::table('domain_checks')->pluck('status_code', 'domain_id');

    return view('domains.index', [
        'domains' => $domains,
        'lastChecks' => $lastChecks,
        'statusCodes' => $statusCodes
    ]);
})->name('domains.index');

Route::post('/domains', function (Request $request) {
    $validatedData = $request->validate([
        'domainName' => 'required|url'
    ]);
    $domainName = Str::lower($validatedData['domainName']);
    
    if (DB::table('domains')->where('name', $domainName)->exists()) {
        flash('Url already exists')->warning();
    } else {
        DB::table('domains')->insert(
            [
                'name' => $domainName,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ]
        );
        flash('Url has been added')->success();
    }

    $id = DB::table('domains')->where('name', $domainName)->value('id');
    return redirect()->route('domains.show', ['id' => $id]);
})->name('domains.store');

Route::get('/domains/{id}', function ($id) {
    $domain = DB::table('domains')->find($id);
    $checks = DB::table('domain_checks')
        ->where('domain_id', $id)
        ->get();
    return view('domains.show', ['domain' => $domain, 'checks' => $checks]);
})->name('domains.show');

Route::post('/domains/{id}/checks', function ($id) {
    $domain = DB::table('domains')->find($id);

    $data = Http::get('$domain->name')->status();
    dump($data);

    /*

    $document = new Document($response_body);
    
    if ($document->has('h1')) {
        $h1 = $document->first('h1')->text();
    }

    if ($document->has('meta[name=keywords][content]')) {
        $keywords = $document->first('meta[name=keywords][content]')->getAttribute('content');
    }

    if ($document->has('meta[name=description][content]')) {
        $description = $document->first('meta[name=description][content]')->getAttribute('content');
    }
    
    DB::table('domain_checks')->insert(
        [
            'domain_id' => $id,
            'status_code' => $response_status,
            'h1' => $h1 ?? null,
            'keywords' => $keywords ?? null,
            'description' => $description ?? null,
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString()
        ]
    );
    flash('Website has been checked!')->success();
    return redirect()->route('domains.show', ['id' => $id]);
    */
})->name('domains.checks');
