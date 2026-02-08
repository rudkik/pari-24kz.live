<?php
namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\League;
use App\Models\Sports;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index()
    {
        $games = Game::all();
        return view('games.index', compact('games'));
    }

    public function create()
    {
        $leagues = League::with('sport')->get();
        $sports = Sports::all();
        return view('games.create', compact('leagues', 'sports'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'league_id' => 'nullable|exists:leagues,id',
            'sport_id' => 'required_without:league_id|exists:sports,id',
            'team1' => 'required|string|max:255',
            'team2' => 'required|string|max:255',
            'active_period' => 'required|string|regex:/^\d+(-\d+)?$/',
            'coefficient1_min' => 'required|numeric|min:1|max:10',
            'coefficient1_max' => 'required|numeric|min:1|max:10',
            'coefficient2_min' => 'required|numeric|min:1|max:10',
            'coefficient2_max' => 'required|numeric|min:1|max:10',
            'type' => 'required|in:live,line,top_league',
        ]);

        $sport_id = $request->sport_id;

        if ($request->league_id) {
            $league = League::findOrFail($request->league_id);
            $sport_id = $league->sport_id;
        }

        $game = new Game($request->all());
        $game->sport_id = $sport_id;
        $game->league_id = $request->league_id ?? null;
        $game->title = 'Матч';

        $period = explode('-', $request->active_period);
        $startDay = (int)$period[0];
        $endDay = isset($period[1]) ? (int)$period[1] : $startDay;
        $game->game_start = now()->addDays(rand($startDay, $endDay));

        $game->coefficient1 = $this->generateRandomCoefficient($request->coefficient1_min, $request->coefficient1_max);
        $game->coefficient2 = $this->generateRandomCoefficient($request->coefficient2_min, $request->coefficient2_max);

        $game->save();

        return redirect()->route('games.index')->with('success', 'Матч успешно создан.');
    }

    private function generateRandomCoefficient($min, $max)
    {
        return round($min + mt_rand() / mt_getrandmax() * ($max - $min), 2);
    }

    public function edit(Game $game)
    {
        $leagues = League::with('sport')->get();
        return view('games.edit', compact('game', 'leagues'));
    }

    public function update(Request $request, Game $game)
    {
        $request->validate([
            'league_id' => 'required|exists:leagues,id',
            'team1' => 'required|string|max:255',
            'team2' => 'required|string|max:255',
            'active_period' => 'required|string|regex:/^\d+(-\d+)?$/',
            'coefficient1_min' => 'required|numeric|min:1|max:10',
            'coefficient1_max' => 'required|numeric|min:1|max:10',
            'coefficient2_min' => 'required|numeric|min:1|max:10',
            'coefficient2_max' => 'required|numeric|min:1|max:10',
            'type' => 'required|in:live,line,top_league',
        ]);

        $league = League::findOrFail($request->league_id);
        $sport_id = $league->sport_id;

        $game->fill($request->all());
        $game->sport_id = $sport_id;
        $game->title = 'Матч';

        $period = explode('-', $request->active_period);
        $startDay = (int)$period[0];
        $endDay = isset($period[1]) ? (int)$period[1] : $startDay;
        $game->game_start = now()->addDays(rand($startDay, $endDay));

        $game->coefficient1 = $this->generateRandomCoefficient($request->coefficient1_min, $request->coefficient1_max);
        $game->coefficient2 = $this->generateRandomCoefficient($request->coefficient2_min, $request->coefficient2_max);

        $game->save();

        return redirect()->route('games.index')->with('success', 'Матч успешно обновлен.');
    }

    public function destroy(Game $game)
    {
        $game->delete();
        return redirect()->route('games.index')->with('success', 'Матч успешно удален.');
    }
}
