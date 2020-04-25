<?php

namespace App\Http\Controllers;

use App\Criteria;
use App\EvGroup;
use App\Http\Requests\OptionRequest;
use App\Matrix;
use App\Option;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class OptionController extends Controller
{

    protected $route = 'option';
    protected $table = 'fv_ev_options';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        Change Model in items

        $items = Option::orderBy('id', 'desc')->paginate(50);
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
        $belongs = ['criteria_id' => Criteria::all()];
        return view('matrix.create', ['name' => $this->route, 'columns' => $array, 'belongs' => $belongs]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OptionRequest $request)
    {
        Option::create($request->all());
        return redirect()->route('option.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function show(Option $option)
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
        $data = Option::findOrFail($id);

        $array = [];
        $columns = Schema::connection('mysql2')->getColumnListing($this->table);
        foreach ($columns as $column) {
            $array[$column] = Schema::connection('mysql2')->getColumnType($this->table, $column);
        }
        $belongs = ['criteria_id' => Criteria::all()];
        return view('matrix.create', ['name' => $this->route, 'columns' => $array, 'belongs' => $belongs, 'data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Option::findOrFail($id)->fill($request->except('id', '_method', '_token'))->save();

        return redirect()->route('option.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $evGroup = Option::findOrFail($id);
        $evGroup->delete();

        return redirect()->route('option.index');
    }
}
