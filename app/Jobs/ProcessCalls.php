<?php

namespace App\Jobs;

use App\Http\Controllers\CallsHistoryController;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ProcessCalls implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $qty;
    protected $caller;

    /**
     * Create a new job instance.
     *
     * @param $qty
     */
    public function __construct($qty)
    {
        $this->caller = new CallsHistoryController();
        $this->qty = $qty;
    }

    /**
     * Execute the job.
     *
     * @param $qty
     * @return void
     * @throws \Throwable
     */
    public function handle()
    {
        try {
            $this->caller->cast($this->qty);
        } catch (\Exception $e) {
            Log::error('ProcessCalls error ' . $e->getMessage());
        }
    }
}
