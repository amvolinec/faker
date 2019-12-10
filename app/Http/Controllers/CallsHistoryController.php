<?php

namespace App\Http\Controllers;

use App\CallsHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CallsHistoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $header = 'Calls History';
        $items = CallsHistory::paginate(30);
        $columns = Schema::connection('mysql2')->getColumnListing('fv_calls_history');
        return view('calls.index', ['header' => $header, 'items' => $items, 'columns' => $columns]);
    }

    public function flash()
    {
        DB::connection('mysql2')->table('fv_calls_history')->delete();
        return redirect()->back()->withInput();
    }
}
