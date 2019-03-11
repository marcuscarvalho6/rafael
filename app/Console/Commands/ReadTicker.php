<?php

namespace App\Console\Commands;

use App\Services\TickerService;
use Illuminate\Console\Command;

class ReadTicker extends Command
{
    private $tickerService;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'read:ticker';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(TickerService $tickerService)
    {
        parent::__construct();
        $this->tickerService = $tickerService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->tickerService->readTicker();
    }
}
