<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Game;
use Carbon\Carbon;

class UpdateGames extends Command
{
    protected $signature = 'games:update';
    protected $description = 'Update games with new random coefficients and start date daily';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $games = Game::all();
        foreach ($games as $game) {
            $period = explode('-', $game->active_period);
            $startDay = (int)$period[0];
            $endDay = isset($period[1]) ? (int)$period[1] : $startDay;

            $game->game_start = now()->addDays(rand($startDay, $endDay));

            $game->coefficient1 = $this->generateRandomCoefficient($game->coefficient1_min, $game->coefficient1_max);
            $game->coefficient2 = $this->generateRandomCoefficient($game->coefficient2_min, $game->coefficient2_max);

            $game->save();
        }

        $this->info('Games updated successfully!');
    }

    private function generateRandomCoefficient($min, $max)
    {
        return round($min + mt_rand() / mt_getrandmax() * ($max - $min), 2);
    }
}
