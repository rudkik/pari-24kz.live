<?php

namespace App\Http\Controllers\Bot\Pari;




use App\Http\Controllers\Controller;
use App\Http\Services\TelegramServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class Contoller extends Controller
{
    protected $token;
    const url = 'https://api.telegram.org/bot';
    public function __construct()
    {
        $this->token = '8571060231:AAE_mYTNj4dxZ9aZuaLNtXnIhy3x3ag8Tug';
    }

    public function setWebhook(){
        $http = Http::post(self::url . $this->token .'/setWebhook?url=https://pari-24kz.live/bot/pari/webhook');
        dd(json_decode($http->body()));
    }


    public function getWebhookInfo(){
        $http = Http::get(self::url . $this->token .'/getWebhookInfo');
        dd(json_decode($http->body()));
    }

    public function webhook(Request $request, TelegramServices $telegramServices){


        $buttonsObj = new Buttons();
        if ($request->has('callback_query') || $request->has('message')) {
            // Обработка данных, пришедших от Telegram
            $query = false;
            if ($request->input('callback_query') !== null) {
                $data = $request->input('callback_query');
                $message = mb_strtolower($data['data'], 'utf-8');
                $chat_id = $data['message']['chat']['id'];
            } else {
                $data = $request->input('message');
                if (!empty($data['text'])){
                    $message = mb_strtolower($data['text'], 'utf-8');
                }else{
                    $message = '/start';
                }

                $chat_id = $data['chat']['id'];
            }


            $buttons = $buttonsObj->buttons($message);

            if ($message == '/start') {
                $message = 'Жми «СТАРТ» чтобы запустить приложение!';
            }

            $telegramServices->sendMessage(self::url . $this->token, $chat_id, $message, $buttons);

        }
        else {
            \Log::info('Unknown request source');
        }
    }
}
