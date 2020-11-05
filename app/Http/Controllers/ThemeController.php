<?php

namespace App\Http\Controllers;

use App\Http\Requests\QueueRequest;
use App\Queue;
use App\Theme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ThemeController extends Controller
{
    private $table = 'fv_call_theme';
    protected $faker;

    /**
     * Display a listing of the resource.
     *
     * @param bool $search
     * @return \Illuminate\Http\Response
     */
    public function index($search = '')
    {
        if (Schema::connection('mysql2')->hasTable($this->table)) {
            $columns = Schema::connection('mysql2')->getColumnListing($this->table);
            if (!empty($search)) {
                $items = DB::connection('mysql2')->table($this->table)->where('name', 'like', '%' . $search . '%')->orderBy('id', 'desc')->paginate(25);
            } else {
                $items = DB::connection('mysql2')->table($this->table)->orderBy('id', 'desc')->paginate(25);
            }

            return view('themes.index', ['columns' => $columns, 'items' => $items, 'name' => $this->table, 'search' => $search ]);
        } else {
            session()->flash('status', 'Table not found!');
            return view('tables.error');
        }
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Theme $theme
     * @return \Illuminate\Http\Response
     */
    public function show(Theme $theme)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Theme $theme
     * @return \Illuminate\Http\Response
     */
    public function edit(Theme $theme)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Theme $theme
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Theme $theme)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Theme $theme
     * @return \Illuminate\Http\Response
     */
    public function destroy(Theme $theme)
    {
        //
    }

    public function add(QueueRequest $request)
    {
        $qty = (int)$request->get('qty');
        factory(Theme::class, $qty)->create();
        return back()->withInput();
    }

    public function find(Request $request)
    {
        $search = $request->get('search');
        return $this->index($search);
    }
}
