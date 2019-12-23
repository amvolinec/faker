<?php

namespace App\Http\Controllers;

use App\Column;
use App\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use MongoDB\Driver\Session;

class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $table)
    {
        $tableModel = $tableModel = Table::where('name', $table)->first();
        $column = null;

        if (empty($tableModel)) {
            $tableModel = Table::create(['name' => $table]);
        }

        foreach ($request->all() as $key => $value) {
            if ($value !== null) {

                $options = is_string($value) ? [$value] : (is_array($value) ? $value : array());

                $column = $tableModel->columns()->where('name', $key)->first();
                if (empty($column)) {
                    $column = Column::create(['name' => $key, 'options' => $options]);
                } else {
                    $column->options = $options;
                }

                $tableModel->columns()->save($column);
            }

        }


        return redirect()->route('columns.info', $table);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Schema::connection('mysql2')->hasTable($id)) {

            $columns = Schema::connection('mysql2')->getColumnListing($id);
            $items = DB::connection('mysql2')->table($id)->paginate(20);
            return view('tables.index', ['columns' => $columns, 'items' => $items, 'name' => $id]);
        } else {
            session()->flash('status', 'Table not found!');
            return view('tables.error');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function info($table)
    {

        if (is_table($table)) {
//            $info = get_columns($table);
            $columns = get_table_schema(config('database.connections.mysql2.database'), $table);
        } else {
            session()->flash('status', $table . __(' not exist'));
            return view('tables.error');
        }

        $tableModel = Table::where('name', $table)->first();

        if (!empty($tableModel)) {
            $columns = $this->addValues($tableModel, $columns);
        }
        return view('tables.info', ['table' => $table, 'columns' => $columns]);
    }

    protected function addValues(Table $tableModel, $columns)
    {
        $values = $tableModel->columns;
        foreach ($columns as $column) {
            foreach ($values as $value) {
                if ($value->name === $column->COLUMN_NAME) {
                    $column->value = json_encode($value->options);
                    $column->values = $value->options;
                }
            }
        }
        return $columns;
    }

}
