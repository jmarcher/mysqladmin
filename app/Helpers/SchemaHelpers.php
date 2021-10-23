<?php

namespace App\Helpers;

use Doctrine\DBAL\Schema\Column;
use Doctrine\DBAL\Schema\ForeignKeyConstraint;
use Doctrine\DBAL\Schema\Table;
use Doctrine\DBAL\Types\StringType;
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

    public function getDatabases():array
    {
        return DB::connection()->getDoctrineSchemaManager()->listDatabases();
    }

    public function createTable(string $schema, array $data):void
    {
        DB::setDatabaseName($schema);
        $table = new Table($data['name'],$this->translateColumns($data['columns']));
        DB::connection()->getDoctrineSchemaManager()->createTable($table);
    }

    private function translateColumns(array $columns):array
    {
        return array_map(function(array $column){
            switch ($column['type']){
                case 'string':
                    return new Column($column['name'], new StringType());
            }
        }, $columns);
    }
}
