<?php
namespace App\Http\Controllers;

use App\Models\Sports;
use Illuminate\Http\Request;

class SportsController extends Controller
{
    public function index()
    {
        $sports = Sports::all();
        return view('sports.index', compact('sports'));
    }

    public function create()
    {
        return view('sports.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'img' => 'nullable|image'
        ]);

        $sport = new Sports($request->except('img'));

        if ($request->hasFile('img')) {
            $imageName = time().'.'.$request->img->extension();
            $request->img->move(public_path('img/sports'), $imageName);
            $sport->img = '/img/sports/' . $imageName;
        }

        $sport->save();
        return redirect()->route('sports.index')->with('success', 'Вид спорта добавлен.');
    }

    public function edit(Sports $sport)
    {
        return view('sports.edit', compact('sport'));
    }

    public function update(Request $request, Sports $sport)
    {
        $request->validate([
            'title' => 'required|string',
            'img' => 'nullable|image'
        ]);

        $sport->fill($request->except('img'));

        if ($request->hasFile('img')) {
            $imageName = time().'.'.$request->img->extension();
            $request->img->move(public_path('img/sports'), $imageName);
            $sport->img = '/img/sports/' . $imageName;
        }

        $sport->save();
        return redirect()->route('sports.index')->with('success', 'Вид спорта обновлен.');
    }

    public function destroy(Sports $sport)
    {
        $sport->delete();
        return redirect()->route('sports.index')->with('success', 'Sport deleted successfully.');
    }
}
