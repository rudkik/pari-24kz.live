<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Game;
use Carbon\Carbon;

class GenerateRandomGames extends Command
{
    protected $signature = 'generate:random-games';

    protected $description = 'Generate random game coefficients and dates daily';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $games = Game::where('type', 'line')->orWhere('type', 'top_league')->get();

        foreach ($games as $game) {
            $game->coefficient1 = rand(100, 200) / 100;
            $game->coefficient2 = rand(100, 300) / 100;
            $game->game_start = $game->generateRandomGameStart();
            $game->save();
        }

        $this->info('Random game coefficients and dates generated successfully.');
    }
}
