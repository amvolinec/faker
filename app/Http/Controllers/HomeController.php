<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        try {
            $tables = DB::connection('mysql2')->select('SHOW TABLES');
            return view('home', compact('tables'));
        } catch (QueryException $e) {
            $msg = $e->getMessage();
            session()->flash('status', 'SQL error ' . $msg);
            return view('tables.error');
        }

    }
}
