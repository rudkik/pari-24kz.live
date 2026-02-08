<?php
namespace App\Http\Controllers;

use App\Models\League;
use App\Models\Sports;
use Illuminate\Http\Request;

class LeagueController extends Controller
{
    public function index()
    {
        $leagues = League::with('sport')->get();
        return view('leagues.index', compact('leagues'));
    }

    public function create()
    {
        $sports = Sports::all();
        return view('leagues.create', compact('sports'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'sport_id' => 'required|exists:sports,id'
        ]);

        $league = new League();
        $league->name = $request->input('name');
        $league->description = $request->input('description');
        $league->sport_id = $request->input('sport_id');

        if ($request->hasFile('icon')) {
            $imageName = time().'.'.$request->icon->extension();
            $request->icon->move(public_path('img/leagues'), $imageName);
            $league->image = 'img/leagues/' . $imageName;
        }

        $league->save();

        return redirect()->route('leagues.index')->with('success', 'Лига добавлена.');
    }

    public function edit(League $league)
    {
        $sports = Sports::all();
        return view('leagues.edit', compact('league', 'sports'));
    }

    public function update(Request $request, League $league)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'sport_id' => 'required|exists:sports,id'
        ]);

        $league->name = $request->input('name');
        $league->description = $request->input('description');
        $league->sport_id = $request->input('sport_id');

        if ($request->hasFile('icon')) {
            $imageName = time().'.'.$request->icon->extension();
            $request->icon->move(public_path('img/leagues'), $imageName);
            $league->image = 'img/leagues/' . $imageName;
        }

        $league->save();

        return redirect()->route('leagues.index')->with('success', 'Лига обновлена.');
    }

    public function destroy(League $league)
    {
        $league->delete();
        return redirect()->route('leagues.index')->with('success', 'Лига удалена.');
    }
}
