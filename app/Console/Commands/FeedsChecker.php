<?php

namespace App\Console\Commands;

use App\Jobs\UpdateFeedsJob;
use App\Models\RssFeed;
use Illuminate\Console\Command;

class FeedsChecker extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:feeds';

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
     * @return int
     */
    public function handle()
    {
        $rss_feeds = RssFeed::all();
        foreach($rss_feeds as $rss_feed){
            UpdateFeedsJob::dispatch($rss_feed)->onQueue("feed_update");
        }
    }
}
