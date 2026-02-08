<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Game;
use Carbon\Carbon;

class UpdateGameDetails extends Command
{
    protected $signature = 'games:update-details';
    protected $description = 'Обновление даты и коэффициентов для матчей';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $games = Game::all();
        foreach ($games as $game) {
            $activePeriod = explode('-', $game->active_period);
            $days = count($activePeriod) === 1 ? [$activePeriod[0], $activePeriod[0]] : $activePeriod;
            $game->updateCoefficientsAndDate($days);
        }

        $this->info('Данные матчей успешно обновлены.');
    }
}
