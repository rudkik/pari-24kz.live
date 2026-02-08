<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PopupNotification extends Model
{
    public function index()
    {
        $notification = PopupNotification::first();
        return view('welcome', compact('notification'));
    }
}
