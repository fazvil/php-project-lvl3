<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Str;

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/domains', function () {
    $domains = DB::table('domains')->get();
    $lastChecks = DB::table('domain_checks')->pluck('created_at', 'domain_id');
    return view('domains.index', ['domains' => $domains, 'lastChecks' => $lastChecks]);
})->name('domains.index');

Route::post('/domains', function (Request $request) {
    $validatedData = $request->validate([
        'domain' => 'required|url'
    ]);
    $domain = Str::lower($validatedData['domain']);
    DB::table('domains')->insertOrIgnore(
        [
            'name' => $domain,
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString()
        ]
    );
    flash('Url has been added')->success();
    $id = DB::table('domains')->where('name', $domain)->value('id');
    return redirect()->route('domains.show', ['id' => $id]);
})->name('domains.store');

Route::get('/domains/{id}', function ($id) {
    $entity = DB::table('domains')->find($id);
    $checks = DB::table('domain_checks')
        ->where('domain_id', $id)
        ->get();
    return view('domains.show', ['entity' => $entity, 'checks' => $checks]);
})->name('domains.show');

Route::post('/domains/{id}/checks', function ($id) {
    $domain = DB::table('domains')
        ->where('id', $id)
        ->value('name');
    $response_status = Http::get($domain)->status();

    DB::table('domain_checks')->insert(
        [
            'domain_id' => $id,
            'status_code' => $response_status,
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString()
        ]
    );
    return redirect()->route('domains.show', ['id' => $id]);
})->name('domains.checks');