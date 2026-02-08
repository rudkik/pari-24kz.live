<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DepositHistory;
use App\Models\WithdrawalRequest;

class DepositController extends Controller
{
    public function getDepositsView(Request $request)
    {
        $deposits = DepositHistory::where('user_id', auth()->id())->orderBy('created_at', 'desc')->get();
        $withdrawalRequests = WithdrawalRequest::where('user_id', auth()->id())->orderBy('created_at', 'desc')->get();

        return view('deposit-history', [
            'deposits' => $deposits,
            'withdrawalRequests' => $withdrawalRequests,
            'request' => $request,
        ]);
    }

    public function show(string $id)
    {
        $deposits = DepositHistory::where('user_id', $id)->get();

        return response()->json($deposits);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'created_at' => 'required|date',
        ]);

        $deposit = DepositHistory::find($id);

        if (!$deposit) {
            return response()->json(['message' => 'Депозит не найден'], 404);
        }

        $deposit->created_at = $request->input('created_at');
        $deposit->save();

        return response()->json(['message' => 'Дата успешно обновлена', 'deposit' => $deposit]);
    }

    public function destroy($id)
    {
        $deposit = DepositHistory::find($id);

        if (!$deposit) {
            return response()->json(['message' => 'Пополнение не найдено'], 404);
        }

        $deposit->delete();

        return response()->json(['message' => 'Пополнение успешно удалено', 'success' => true]);
    }

}
