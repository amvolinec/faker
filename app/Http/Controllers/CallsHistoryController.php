<?php

namespace App\Http\Controllers;

use App\Agent;
use App\CallsHistory;
use App\CallTheme;
use App\Http\Requests\CallsHistoryRequest;
use App\Http\Requests\FakeCallRequest;
use App\Jobs\ProcessCalls;
use App\Queue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Faker\Factory as Faker;

class CallsHistoryController extends Controller
{
    protected $faker;
    protected $agents;
    protected $queues;
    protected $queues_in;
    protected $queues_out;
    protected $queues_local;

    public function __construct()
    {
        $this->middleware('auth');
        $this->faker = Faker::create('lt_LT');
        ini_set('max_execution_time', 0);
    }

    public function index()
    {
        $header = 'Calls History';
        $items = CallsHistory::orderBy('id', 'desc')->paginate(25);
        $columns = Schema::connection('mysql2')->getColumnListing('fv_calls_history');
        return view('calls.index', ['header' => $header, 'items' => $items, 'columns' => $columns]);
    }

    public function flash()
    {
        DB::connection('mysql2')->table('fv_call_review_record')->delete();
        DB::connection('mysql2')->table('fv_call_review')->delete();
        DB::connection('mysql2')->table('fv_calls_history')->delete();
        return redirect()->back()->withInput();
    }

    public function factory(CallsHistoryRequest $request)
    {
        $time_start = microtime(true);
        $qty = $request->input('qty');

        factory(CallsHistory::class, $qty)->create();

        $execution_time = (microtime(true) - $time_start);
        session()->flash('status', 'Completed ' . number_format($execution_time, 4) . ' sec.');

        return redirect()->route('calls.history');
    }

    public function add(CallsHistoryRequest $request)
    {
        $time_start = microtime(true);
        $qty = $request->input('qty');

        $this->agents = $this->getAgents();
        $this->queues['in'] = $this->getQueuesIn();

        if ($qty < 2000) {
            $this->cast($qty);
        } else {
            $this->bigCast($qty);
        }

        $execution_time = (microtime(true) - $time_start);

        session()->flash('status', 'Completed ' . number_format($execution_time, 4) . ' sec.');

        return redirect()->route('calls.history');

    }

    protected function getAgents()
    {
        return DB::connection('mysql2')->table('fv_agents')->get();
    }

    protected function getQueuesIn()
    {
        return DB::connection('mysql2')->table('fv_queues')->where([['is_outbound', 0], ['id', '>', 0]])->get();
    }

    /**
     * @param $data
     * @throws \Throwable
     */
    public function getTransaction($data): void
    {
        DB::connection('mysql2')->transaction(function () use ($data) {
            DB::connection('mysql2')->table('fv_calls_history')->insert($data);
        });
    }

    /**
     * @param $qty
     * @return array
     */
    public function getDataIn($qty): array
    {
        $data = array();

        for ($i = 1; $i <= $qty; $i++) {
            $direction = $this->faker->randomElement(['in', 'in', 'in', 'in', 'in', 'in', 'out']);
            $agent = $this->getAgent($this->faker->randomElement($this->agents));
            $queue_id = $this->faker->randomElement($agent->queues->pluck('id'));
            $theme_id = $this->faker->randomElement($this->getTheme($queue_id));

            $phones = [
                preg_replace('/[^0-9]/', '', $this->faker->phoneNumber),
                $agent->username
            ];

            $data[] = array(
                'realtime_queues_log_callid' => $this->getRealtimeId(),
                'date_created' => date('y-m-d H:i:s'),
                'date_updated' => date('y-m-d H:i:s'),
                'fv_agents_id' => $agent->id,
                'fv_queues_id' => empty($queue_id) ? 0 : $queue_id,
                'caller_id' => ('in' == $direction ? $phones[0] : $phones[1]),
                'called_id' => ('in' == $direction ? $phones[1] : $phones[0]),
                'is_answered' => 1,
                'is_missed' => 0,
                'waiting_duration' => $this->faker->randomNumber(2),
                'call_duration' => $this->faker->randomNumber(3),
                'direction' => $direction,
                'completed_by' => $this->faker->randomElement(['n/a', 'agent', 'caller']),
                'fv_call_theme_id' => empty($theme_id) ? 0 : $theme_id
            );
        }
        return $data;
    }

    protected function getRealtimeId()
    {
        return (string)time() . '.' . $this->faker->randomNumber(3);
    }

    protected function getTheme($queue_id)
    {
        return CallTheme::where([
            ['fv_queues_id', $queue_id],
            ['deleted', 0]
        ])->pluck('id');
    }

    protected function getAgent($agent_id)
    {
        return Agent::findOrFail($agent_id);
    }

    public function job(CallsHistoryRequest $request)
    {
        $qty = $request->input('qty');

        $max_rows = config('app.max_insert_rows', 1000);
        $cycles = gmp_div_qr($qty, $max_rows, GMP_ROUND_ZERO);

        for ($i = 1; $i <= $cycles[0]; $i++) {
            dispatch((new ProcessCalls($max_rows))->onQueue('calls'));
        }

        if ($cycles[1] > 0) {
            dispatch((new ProcessCalls($cycles[1]))->onQueue('calls'));
        }

        session()->flash('status', 'Your job added to Queue');
        return redirect()->route('calls.history');
    }

    /**
     * @param $qty
     * @throws \Throwable
     */
    public function cast($qty): void
    {
        $this->getData();
        $data = $this->getDataIn($qty);
        $this->getTransaction($data);
    }

    public function faker()
    {
        $items = CallsHistory::paginate(25);
        $columns = Schema::connection('mysql2')->getColumnListing('fv_calls_history');
        return view('calls.maker', ['items' => $items, 'columns' => $columns]);
    }

    public function fake(FakeCallRequest $request)
    {
        factory(CallsHistory::class, 1)->create([
            'called_id' => $request->get('called_id'),
            'caller_id' => $request->get('caller_id'),
            'is_answered' => $request->has('is_answered') ? 1 : 0,
            'waiting_duration' => $request->has('is_answered') ? $this->faker->randomNumber(2) : 0,
            'call_duration' => $request->has('is_answered') ? $this->faker->randomNumber(3) : 0,
            'direction' => $request->get('direction'),
        ]);

        return back()->withInput();
    }

    public function bigCast($qty)
    {
        $max_rows = config('app.max_insert_rows', 2000);
        $cycles = gmp_div_qr($qty, $max_rows, GMP_ROUND_ZERO);

        for ($i = 1; $i <= $cycles[0]; $i++) {
            $this->cast($max_rows);
        }

        if ($cycles[1] > 0) {
            $this->cast($cycles[1]);
        }
        Log::info('Job finished. Cycles: ' . $cycles[0] . ' Rest: ' . $cycles[1]);
    }

    protected function getData()
    {
        $this->agents = Agent::pluck('id');
        $this->queues_in = Queue::where('is_outbound', 0)->where('id', '>', 0)->pluck('id');
        $this->queues_out = Queue::where('is_outbound', 1)->where('id', '>', 0)->pluck('id');
        $this->queues_local = Queue::where('is_local', 1)->where('id', '>', 0)->pluck('id');
    }
}
