<?php

namespace App\Http\Controllers;

use App\Agent;
use App\Http\Requests\AddAgentsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AgentController extends Controller
{
    private $table = 'fv_agents';

    public function index()
    {
        if (Schema::connection('mysql2')->hasTable($this->table)) {

            $columns = Schema::connection('mysql2')->getColumnListing($this->table);
            $items = DB::connection('mysql2')->table($this->table)->paginate(25);
            return view('agents.index', ['columns' => $columns, 'items' => $items, 'name' => $this->table]);
        } else {
            session()->flash('status', 'Table not found!');
            return view('tables.error');
        }
    }

    public function show($id)
    {
        $agent = Agent::findOrFail($id);
        return view('agents.show', compact('agent'));
    }

    public function destroy($id)
    {
        $agent = Agent::findOrFail($id);
        $agent->delete();
        return back()->with('status', 'Success');
    }

    public function add(AddAgentsRequest $request)
    {
        $qty = $request->get('qty');

        factory(Agent::class, 1)->create();

        return back()->withInput();
    }
}
