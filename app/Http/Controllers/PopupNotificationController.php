<?php

namespace App\Http\Controllers;

use App\Models\PopupNotification;
use Illuminate\Http\Request;

class PopupNotificationController extends Controller
{
    public function edit()
    {
        $notification = PopupNotification::first();
        return view('private.popup-notification.edit', compact('notification'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $notification = PopupNotification::first();
        if (!$notification) {
            $notification = new PopupNotification();
        }
        $notification->title = $request->title;
        $notification->content = $request->content;
        $notification->save();

        return redirect()->route('private.popup-notification.edit')->with('success', 'Уведомление успешно обновлено.');
    }

    public static function getNotification()
    {
        return PopupNotification::first();
    }
}
