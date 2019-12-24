<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImportStoreRequest;
use App\Import;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ImportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $columns = Schema::getColumnListing('imports');
        $items = DB::table('imports')->paginate(20);
        return view('import.index', ['columns' => $columns, 'items' => $items]);
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
    public function store(ImportStoreRequest $request)
    {
        $file = $request->file('file');
//        $path = $file->store('sql');
        $new_file_name = date('ymd_His_') . $file->getClientOriginalName();
        $path = $request->file('file')->storeAs(
            'sql', $new_file_name
        );

        Import::create([
            'name' => $file->getClientOriginalName(),
            'path' => $path,
            'user_id' => Auth::id()
        ]);
        return $path;
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Import $import
     * @return \Illuminate\Http\Response
     */
    public function show(Import $import)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Import $import
     * @return \Illuminate\Http\Response
     */
    public function edit(Import $import)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Import $import
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Import $import)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Import $import
     * @return \Illuminate\Http\Response
     */
    public function destroy(Import $import)
    {
        //
    }
}
