<?php

use Illuminate\Support\Facades\DB;

function is_table($table = false)
{
    if (!$table) {
        return false;
    }
    return Schema::connection('mysql2')->hasTable($table);
}

function get_columns($table = false)
{
    if (!$table) {
        return null;
    }
    return Schema::connection('mysql2')->getColumnListing($table);
}

function get_column_schema($database, $table, $column)
{
    return DB::connection('schema')->table('columns')
        ->where('table_schema', $database)
        ->where('table_name', $table)
        ->where('column_name', $column)
        ->get();
}

function get_table_schema($database, $table)
{
    return DB::connection('schema')->table('columns')
        ->where('table_schema', $database)
        ->where('table_name', $table)
        ->get();
}