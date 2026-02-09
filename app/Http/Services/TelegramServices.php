<?php


namespace App\Http\Services;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class TelegramServices
{
    protected $http;

    public function __construct(Http $http)
    {
        $this->http = $http;
    }

    public function sendMessage($url, $chat_id, $message, $buttons = null)
    {
        try {
            // Отправляем запрос
            $response = $this->http::post($url . '/sendMessage', [
                'chat_id' => $chat_id,
                'text' => $message,
                'parse_mode' => 'html',
                'reply_markup' => $buttons,
            ]);

            // Логируем успешный ответ
            \Log::info('Telegram API response:', [
                'url' => $url,
                'chat_id' => $chat_id,
                'message' => $message,
                'response' => $response->json(), // Или $response->body() для получения сырых данных
            ]);

            return $response;
        } catch (\Exception $e) {
            // Логируем ошибку
            \Log::error('Telegram API error:', [
                'url' => $url,
                'chat_id' => $chat_id,
                'message' => $message,
                'error' => $e->getMessage(),
            ]);

            throw $e; // Пробрасываем ошибку дальше, если нужно
        }
    }

    public function sendDocument($url, $chat_id, $path_file = null)
    {
        $file = Storage::path('public/' . $path_file);

        return $this->http::attach(
            'document',
            file_get_contents($file),
            basename($file)
        )->post($url . '/sendDocument', [
            'chat_id' => $chat_id
        ]);
    }

    public function editMessage($url, $chat_id, $message, $buttons, $message_id)
    {
        return  $this->http::post($url . '/editMessageText', [
            'chat_id' => $chat_id,
            'text' => $message,
            'parse_mode' => 'html',
            'reply_markup' => $buttons,
            'message_id' => $message_id,
        ]);
    }

    public function sendPhoto($url, $chat_id, $path_photo, $caption = null, $buttons = null)
    {
        $file = $path_photo;

        return $this->http::post($url . '/sendPhoto', [
            'photo' => $file,
            'chat_id' => $chat_id,
            'caption' => $caption, // Текст сообщения (если нужно)
            'parse_mode' => 'html',
            'reply_markup' => $buttons, // Кнопки (если есть)
        ]);
    }

    public function deleteMessage($url, $chat_id, $message_id)
    {
        return $this->http::post($url . '/deleteMessage', [
            'chat_id'    => $chat_id,
            'message_id' => $message_id,
        ]);
    }
}
