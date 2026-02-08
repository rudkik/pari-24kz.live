<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RejectionReason;

class RejectionReasonController extends Controller
{
    public function index()
    {
        $reasons = RejectionReason::all();
        return view('rejection-reasons.index', compact('reasons'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        RejectionReason::create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('rejection-reasons.index')->with('success', 'Причина отказа добавлена успешно');
    }

    public function edit(RejectionReason $rejectionReason)
    {
        return view('rejection-reasons.edit', compact('rejectionReason'));
    }

    public function update(Request $request, RejectionReason $rejectionReason)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $rejectionReason->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('rejection-reasons.index')->with('success', 'Причина отказа обновлена успешно');
    }

    public function destroy(RejectionReason $rejectionReason)
    {
        $rejectionReason->delete();

        return redirect()->route('rejection-reasons.index')->with('success', 'Причина отказа удалена успешно');
    }
}
