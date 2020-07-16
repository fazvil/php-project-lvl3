<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class DomainController extends Controller
{
    public function __invoke()
    {
        return view('welcome');
    }
}
