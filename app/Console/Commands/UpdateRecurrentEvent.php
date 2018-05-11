<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Event;

class UpdateRecurrentEvent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:events';

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
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $event = Event::where('id', 31)->first();
        $event->start_timestamp = date('Y-m-d H:i');
        $event->save();
    }
}
