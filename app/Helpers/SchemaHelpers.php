<?php

namespace App\Helpers;

use Doctrine\DBAL\Schema\ForeignKeyConstraint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SchemaHelpers
{
    public function getTables(string $schema): array
    {
        DB::setDatabaseName($schema);
        return DB::connection()->getDoctrineSchemaManager()->listTableNames();
    }

    private function getForeignKey(string $table, string $column):?array{

        return collect(DB::connection()->getDoctrineSchemaManager()->listTableForeignKeys($table))
        ->filter(function(ForeignKeyConstraint $foreignKey) use ($column){
            return in_array($column, $foreignKey->getLocalColumns());
        })
            ->map(function (ForeignKeyConstraint $foreignKey){
                return [
                    'table_name' => $foreignKey->getForeignTableName(),
                    'table_keys' => $foreignKey->getForeignColumns(),
                ];
            })
        ->first();
    }

    public function getTableColumns(string $schema, string $table): array
    {
        DB::setDatabaseName($schema);
        return collect(Schema::getColumnListing($table))->map(function (string $column) use ($table) {
            return [
                'name' => $column,
                'info' => Schema::getColumnType($table, $column),
                'foreign_key' => $this->getForeignKey($table, $column),
            ];
        })->toArray();
    }

    public function getTableData(string $schema, string $table, ?array $filters = null): array
    {
        DB::setDatabaseName($schema);
        $query = DB::table($table);

        if($filters){
            foreach($filters as $column => $value){
                // TODO:Improve for different operators
                $query->where($column, '=',  $value);
            }
        }
        return $query->get()->toArray();
    }
}
