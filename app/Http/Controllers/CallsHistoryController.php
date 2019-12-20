<?php

namespace App\Http\Controllers;

use App\CallsHistory;
use App\Http\Requests\CallsHistoryRequest;
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


    public function __construct()
    {
        $this->middleware('auth');
        $this->faker = Faker::create('lt_LT');
    }

    public function index()
    {
        $header = 'Calls History';
        $items = CallsHistory::paginate(25);
        $columns = Schema::connection('mysql2')->getColumnListing('fv_calls_history');
        return view('calls.index', ['header' => $header, 'items' => $items, 'columns' => $columns]);
    }

    public function flash()
    {
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

        for ($i = 0; $i <= $qty; $i++) {
            $data[] = array(
                'realtime_queues_log_callid' => 'Informacija',
                'date_created' => date('y-m-d H:i:s'),
                'date_updated' => date('y-m-d H:i:s'),
                'fv_agents_id' => 1,
//                'fv_agents_id' => $this->agents{0}->id,
//                'fv_queues_id' => $this->queues['in']{0}->id,
                'fv_queues_id' => 4,
                'caller_id' => $this->faker->phoneNumber,
//                'called_id' => $this->agents{0}->username,
                'called_id' => 1001,
                'is_answered' => 1,
                'is_missed' => 0,
                'waiting_duration' => $this->faker->randomNumber(2),
                'call_duration' => $this->faker->randomNumber(3),
                'direction' => 'in',
                'completed_by' => 'agent',
                'fv_call_theme_id' => 1
            );
        }
        return $data;
    }

    /**
     * @param $qty
     * @throws \Throwable
     */
    public function cast($qty): void
    {
        $data = $this->getDataIn($qty);
        $this->getTransaction($data);
    }

    protected function bigCast($qty)
    {
        $max_rows = config('app.max_insert_rows', 2000);
        $cycles = gmp_div_qr($qty, $max_rows, GMP_ROUND_ZERO);

        for ($i = 1; $i <= $cycles[0]; $i++) {
            $this->cast($max_rows);
        }

        if ($cycles[1] > 0) {
            $this->cast($cycles[1]);
        }
        Log::info('Cycles: ' . $cycles[0] . ' Rest: ' . $cycles[1]);
    }
}
