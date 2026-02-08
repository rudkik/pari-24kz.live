<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stavka;
use App\Models\User;

class BetsController extends Controller
{
    public function betsSuccess(Request $request)
    {
        $stavka = Stavka::where('id', $request->id)->first();
        $stavka->status = 'Победа';
        $stavka->save();

        $user = User::find($stavka->user);
        $user->money += $stavka->summa * $stavka->k;
        $user->save();

        return 1;
    }
}
