<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class SchemaHelpers
{
    public function getTables(string $schema):array
    {
        DB::setDatabaseName($schema);
        return DB::connection()->getDoctrineSchemaManager()->listTableNames();
    }
}
