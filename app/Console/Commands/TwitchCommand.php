<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\Twitch\Twitch;
use App\Console\Commands\Log;

class TwitchCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Twitch-go';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Go to stream url';

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

        Twitch::goToUrl();

        $this->info('---------------------------------');
        $this->info('Redirect to stream url');
        $this->info('---------------------------------');
        
        \Log::info("Un stream a été ouvert depuit le terminale");

    }
}
