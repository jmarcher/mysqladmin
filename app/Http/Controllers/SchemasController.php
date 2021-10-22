<?php

namespace App\Http\Controllers;

use App\Helpers\SchemaHelpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class SchemasController extends Controller
{
    public function index(Request $request, SchemaHelpers $helper, string $selectedSchema = null)
    {
        if($selectedSchema === null){
            $selectedSchema = config('database.connections.'.config('database.default').'.database');
        }
         return Inertia::render('Schemas/Index', [
             'schema' => $selectedSchema,
             'tables' => $helper->getTables($selectedSchema),
         ]);
    }

    public function viewData(Request $request, SchemaHelpers $helper, string $selectedSchema = null)
    {
        if($selectedSchema === null){
            $selectedSchema = config('database.connections.'.config('database.default').'.database');
        }
         return Inertia::render('Schemas/ViewData', [
             'schema' => $selectedSchema,
             'tables' => $helper->getTables($selectedSchema),
         ]);
    }
}
