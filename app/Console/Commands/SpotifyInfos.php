<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Services\Spotify\Spotify;

class SpotifyInfos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Spotify info';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Informations principales du component Spotify';

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
        $data = Spotify::infos();
   
        $this->info('');
        $this->info('---------------------------------');
        $this->info('Voici les informations de Spotify');
        $this->info('---------------------------------');
        $this->info('');
        $this->comment('Current song');
        $this->line($data['song']['name']);
        $this->info('');
        $this->comment('Artiste');
        $this->line($data['artiste']['name']);
        $this->info('');
        $this->comment('Album');
        $this->line($data['album']['name']);
    }
}
