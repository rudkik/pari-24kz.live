<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MatchLimit;

class MatchLimitController extends Controller
{
    public function index()
    {
        $limits = MatchLimit::all();
        return view('match_limits.index', compact('limits'));
    }

    public function edit($id)
    {
        $limit = MatchLimit::findOrFail($id);
        return view('match_limits.edit', compact('limit'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'limit' => 'required|integer',
        ]);

        $limit = MatchLimit::findOrFail($id);
        $limit->update(['limit' => $request->limit]);

        return redirect()->route('match-limits.index')->with('success', 'Ограничитель обновлен');
    }
}
