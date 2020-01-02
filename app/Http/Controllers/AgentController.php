<?php

namespace App\Http\Controllers;

use App\Agent;
use App\AgentStatus;
use App\Group;
use App\Person;
use App\Http\Requests\AddAgentsRequest;
use App\PersonAuth;
use App\Queue;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Faker\Factory as Faker;

class AgentController extends Controller
{
    private $table = 'fv_agents';
    private $date;
    protected $faker;
    protected $queues_out;
    protected $queues_local;

    public function __construct()
    {
        $this->middleware('auth');
        $this->date = new \DateTime();
        $this->faker = Faker::create('lt_LT');
    }

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

        DB::connection('mysql2')->table('fv_agents_status')->where('fv_agents_id', $id)->delete();

        $agent = Agent::findOrFail($id);
        $agent->delete();

        return back()->with('status', 'Success');
    }

    public function add(AddAgentsRequest $request)
    {
        $qty = $request->get('qty');
        if ('true' == $request->get('is_old')) {
            return $this->addOld($qty);
        } else {
            factory(Agent::class, 1)->create();
            return back()->withInput();
        }
    }

    protected function addOld($qty)
    {
        $this->queues_out = Queue::where('is_outbound', 1)->where('id', '>', 0)->pluck('id');
        $this->queues_local = Queue::where('is_local', 1)->where('id', '>', 0)->pluck('id');

        try {

            $person = $this->createPerson();
            $agent = $this->createAgent($person);

        } catch (Exception $e) {
            session()->flash('status', $e->getMessage());
            return view('tables.error');
        }

        AgentStatus::create([
            'fv_agents_id' => $agent->id,
            'date_updated' => $this->date,
            'fv_pauses_id' => 0,
        ]);

        PersonAuth::create([
            'fv_persons_id' => $person->id,
            'fv_auth_types_id' => 3,
            'fv_auth_ident' => $agent->id,
            'date_created' => $this->date,
        ]);

        return back()->with('status', 'New agent added');
    }

    protected function createPerson()
    {
        return Person::create([
            'cl_sys_id' => 'TESTAS',
            'company' => $this->faker->company,
            'name' => $this->faker->name,
            'email' => $this->faker->safeEmail,
            'phone' => '860600000',
            'username' => $this->faker->unique()->numberBetween(5000, 7000),
            'password' => '824824',
//            'password' => '05f8d65498349a9273d9d7a6d4c15b39fad3e046b1f241fb88009976ab2763da',
//            'salt' => '8ycawTIO',
            'is_deleted' => 0,
            'date_created' => $this->date,
            'date_updated' => $this->date,
//            'date_visited' => $this->date,
            'date_pass_changed' => date('Y-m-d H:i:s', strtotime("-1 months")),
            'changed_by_username' => 'admin',
        ]);
    }

    protected function createAgent(Person $person)
    {
        $group = Group::where('name', 'agentai')->pluck('id');

        return Agent::create([
            'groups_id' => isset($group[0]) ? $group[0] : 0,
            'date_created' => $this->date,
            'date_updated' => $this->date,
            'username' => $person->username,
            'password' => $person->username,
            'name' => $person->name,
            'email' => $person->email,
            'fv_queues_id_outbound' => $this->faker->randomElement($this->queues_out),
            'fv_queues_id_local' => $this->faker->randomElement($this->queues_local),
            'is_password_required' => 1,
        ]);
    }
}
