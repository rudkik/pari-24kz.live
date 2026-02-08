<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MatchNotification;

class MatchNotificationController extends Controller
{
    public function edit()
    {
        $notification = MatchNotification::first();
        return view('match_notifications.edit', compact('notification'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        $notification = MatchNotification::first();

        if ($notification) {
            $notification->update(['message' => $request->message]);
        } else {
            MatchNotification::create(['message' => $request->message]);
        }

        return redirect()->route('matchNotf.edit')->with('success', 'Уведомление обновлено');
    }

    public static  function getNotification()
    {
        return MatchNotification::first();
    }
}
