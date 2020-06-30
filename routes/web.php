<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/domains', function () {
    $domains = DB::table('domains')->get();
    return view('domains.index', ['domains' => $domains]);
})->name('domains.index');

Route::post('/domains', function (Request $request) {
    $validatedData = $request->validate([
        'domain' => 'required|url'
    ]);
    DB::table('domains')->insertOrIgnore(
        [
            'name' => $validatedData['domain'],
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString()
        ]
    );
    flash('Url has been added')->success();
    $id = DB::table('domains')->where('name', $validatedData['domain'])->value('id');
    return redirect()->route('domains.show', ['id' => $id]);
})->name('domains.store');

Route::get('/domains/{id}', function ($id) {
    $user = DB::table('domains')->find($id);
    return view('domains.show', ['user' => $user]);
})->name('domains.show');
