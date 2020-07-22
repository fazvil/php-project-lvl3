<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Str;
use DiDom\Document;

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/domains', function () {
    $domains = DB::table('domains')->get();
    $lastChecks = DB::table('domain_checks')
        ->select('domain_id', 'created_at', 'status_code')
        ->orderBy('domain_id')
        ->orderByDesc('created_at')
        ->distinct('domain_id')
        ->get()
        ->keyBy('domain_id');
        
    return view('domains.index', ['domains' => $domains, 'lastChecks' => $lastChecks]);
})->name('domains.index');

Route::post('/domains', function (Request $request) {
    $validatedData = $request->validate([
        'domainName' => 'required|url'
    ]);
    $domainName = Str::lower($validatedData['domainName']);
    
    if (DB::table('domains')->where('name', $domainName)->exists()) {
        flash('Url already exists')->warning();
    } else {
        $id = DB::table('domains')->insertGetId(
            [
                'name' => $domainName,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ]
        );
        flash('Url has been added')->success();
    }

    return redirect()->route('domains.show', ['id' => $id]);
})->name('domains.store');

Route::get('/domains/{id}', function ($id) {
    $domain = DB::table('domains')->find($id) ?? abort(404);
    $checks = DB::table('domain_checks')->where('domain_id', $id)->get();

    return view('domains.show', ['domain' => $domain, 'checks' => $checks]);
})->name('domains.show');

Route::post('/domains/{id}/checks', function ($id) {
    $domain = DB::table('domains')->find($id);
    $data = Http::get($domain->name);
    $response_body = $data->body();
    $response_status = $data->status();

    $document = new Document($response_body);
    
    $h1 = optional($document->first('h1'))->text();
    $keywords = optional($document->first('meta[name=keywords]'))->attr('content');
    $description = optional($document->first('meta[name=description]'))->attr('content');
    
    DB::table('domain_checks')->insert(
        [
            'domain_id' => $id,
            'status_code' => $response_status,
            'h1' => $h1,
            'keywords' => $keywords,
            'description' => $description,
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString()
        ]
    );
    flash('Website has been checked!')->success();
    
    return redirect()->route('domains.show', ['id' => $id]);
})->name('domains.checks');
