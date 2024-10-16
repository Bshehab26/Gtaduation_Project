<?php

namespace App\Console\Commands;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Console\Command;

class UpdateEventStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'events:update-event-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'updating event status from upcoming to ongoing to ended.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = Carbon::now();
        Event::where('status', 'upcoming')
                ->where('start_time', '<=', $now)
                ->where('end_time', '>=', $now)
                ->update(['status' => 'ongoing']);

        Event::where('status', 'ongoing')
                ->where('end_time', '<=', $now)
                ->update(['status' => 'ended']);
    }
}
