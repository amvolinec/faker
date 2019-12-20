<?php

namespace App\Http\Controllers;

use App\Column;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ColumnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $name = 'Columns';
        $columns = Schema::getColumnListing('columns');
        $items = Column::paginate(25);
        return view('tables.index', ['columns' => $columns, 'items' => $items, 'name' => $name, 'prefix' => 'column']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tables = DB::connection('mysql2')->select('SHOW TABLES');
        return view('columns.create', ['tables' => $tables]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Column $column
     * @return \Illuminate\Http\Response
     */
    public function show(Column $column, $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Column $column
     * @return \Illuminate\Http\Response
     */
    public function edit(Column $column)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Column $column
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Column $column)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Column $column
     * @return \Illuminate\Http\Response
     */
    public function destroy(Column $column)
    {
        //
    }
}
