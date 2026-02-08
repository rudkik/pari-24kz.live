<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DogovorNotification;

class DogovorNotificationController extends Controller
{
    public function edit()
    {
        $notification = DogovorNotification::first();
        return view('dogovor_notifications.edit', compact('notification'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        $notification = DogovorNotification::first();

        if ($notification) {
            $notification->update(['message' => $request->message]);
        } else {
            DogovorNotification::create(['message' => $request->message]);
        }

        return redirect()->route('dogovorNotf.edit')->with('success', 'Уведомление обновлено');
    }

    public static function getNotification()
    {
        return DogovorNotification::first();
    }
}
