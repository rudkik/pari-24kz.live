<?php

namespace App\Http\Controllers\Bot\Pari;


use App\Http\Controllers\Controller;

class Buttons extends Controller
{
    public function buttons($message = null){

        if ($message == '/start') {
            $buttons = [
                'resize_keyboard' => true,
                'keyboard' => [
                    [
                        [
                            'text' => 'СТАРТ',
                            'web_app' => ['url' => 'https://pari-24kz.live'],
                        ],
                    ],
                ],
            ];
           }
        else {
            $buttons = [
                'resize_keyboard' => true,
                'keyboard' => [
                    [
                        [
                            'text' => 'СТАРТ',
                            'web_app' => ['url' => 'https://pari-24kz.live'],
                        ],
                    ],
                ],
            ];
        }

        return $buttons;
    }

}
