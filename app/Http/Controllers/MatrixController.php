<?php

namespace App\Http\Controllers;

use App\CallsHistory;
use App\Matrix;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class MatrixController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $route = 'matrix';
        $items = Matrix::orderBy('id', 'desc')->paginate(50);
        $columns = Schema::connection('mysql2')->getColumnListing('fv_ev_matrix');
        return view('matrix.index', ['route' => $route, 'items' => $items, 'columns' => $columns]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $name = 'matrix';
        $array = [];
        $columns = Schema::connection('mysql2')->getColumnListing('fv_ev_matrix');
        foreach ($columns as $column) {
            $array[$column] = Schema::connection('mysql2')->getColumnType('fv_ev_matrix', $column);
        }
        return view('matrix.create', ['name' => $name, 'columns' => $array]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Matrix::create($request->all());
        return redirect()->route('matrix.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Matrix  $matrix
     * @return \Illuminate\Http\Response
     */
    public function show(Matrix $matrix)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Matrix  $matrix
     * @return \Illuminate\Http\Response
     */
    public function edit(Matrix $matrix)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Matrix  $matrix
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Matrix $matrix)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Matrix  $matrix
     * @return \Illuminate\Http\Response
     */
    public function destroy(Matrix $matrix)
    {
        //
    }
}
