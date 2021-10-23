<?php

namespace App\Http\Controllers;

use App\Helpers\SchemaHelpers;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TablesController extends Controller
{

    public function create(SchemaHelpers $helper, string $selectedSchema)
    {
        return Inertia::render("Schemas/CreateTable", [
            'schema' => $selectedSchema,
            'tables' => $helper->getTables($selectedSchema),
        ]);
    }

    public function store(Request $request, string $selectedSchema, SchemaHelpers $helper)
    {
        $this->validate($request, ['name' => 'required']);

        $helper->createTable($selectedSchema, $request->all());

        return redirect()->to("/schemas/{$selectedSchema}/data?table={$request->name}");
    }
}
