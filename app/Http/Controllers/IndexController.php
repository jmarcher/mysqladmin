<?php

namespace App\Http\Controllers;

use App\Helpers\SchemaHelpers;
use Illuminate\Http\Request;
use Inertia\Inertia;

class IndexController extends Controller
{
    public function __invoke(Request $request, SchemaHelpers $helper)
    {
        return Inertia::render('Index', [
            'databases' => $helper->getDatabases(),
        ]);
    }
}
