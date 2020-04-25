<?php

namespace App\Http\Controllers;

use App\Criteria;
use App\EvGroup;
use App\Matrix;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class EvGroupController extends Controller
{
    protected $route = 'group';
    protected $table = 'fv_ev_group';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = EvGroup::orderBy('id', 'desc')->paginate(50);
        $columns = Schema::connection('mysql2')->getColumnListing($this->table);
        return view('matrix.index', ['route' => $this->route, 'items' => $items, 'columns' => $columns, 'delete' => true]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $array = [];
        $columns = Schema::connection('mysql2')->getColumnListing($this->table);
        foreach ($columns as $column) {
            $array[$column] = Schema::connection('mysql2')->getColumnType($this->table, $column);
        }
        $belongs = ['matrix_id' => Matrix::all()];
        return view('matrix.create', ['name' => $this->route, 'columns' => $array, 'belongs' => $belongs]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        EvGroup::create($request->all());
        return redirect()->route('group.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EvGroup  $evGroup
     * @return \Illuminate\Http\Response
     */
    public function show(EvGroup $evGroup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = EvGroup::findOrFail($id);

        $array = [];
        $columns = Schema::connection('mysql2')->getColumnListing($this->table);
        foreach ($columns as $column) {
            $array[$column] = Schema::connection('mysql2')->getColumnType($this->table, $column);
        }
        $belongs = ['matrix_id' => Matrix::all(), 'group_id' => EvGroup::all()];
        return view('matrix.create', ['name' => $this->route, 'columns' => $array, 'belongs' => $belongs, 'data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        EvGroup::findOrFail($id)->fill($request->except('id', '_method', '_token'))->save();

        return redirect()->route('group.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $evGroup = EvGroup::findOrFail($id);
        $evGroup->delete();

        return redirect()->route('group.index');
    }
}
