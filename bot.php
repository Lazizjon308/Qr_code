<?php
declare(strict_types=1);

require 'vendor/autoload.php';
require 'credentials.php';

use GuzzleHttp\Client;

class Bot {
    private string $api;
    private Client $http;
    private string $text;
    private int $chatId;
    private string $firstName;

    public function __construct() {
        $this->api  = "https://api.telegram.org/bot{$_ENV['TELEGRAM_BOT_TOKEN']}/";
        $this->http = new Client(['base_uri' => $this->api]);
    }

    public function handle(string $update): void {
        $update = json_decode($update, true);

        $this->text      = $update['message']['text'];
        $this->chatId    = $update['message']['chat']['id'];
        $this->firstName = $update['message']['chat']['first_name'];

        match ($this->text) {
            '/start' => $this->handleStartCommand(),
            '/list'  => $this->handleListCommand(),
            default  => $this->handleUnknownCommand(),
        };
    }

    private function handleStartCommand(): void {
        $text = "Assalomu alaykum, {$this->firstName}!\n\n";
        $text .= "Botimizga xush kelibsiz!\n\n";
        $text .= "Botdan foydalanish uchun quyidagi buyruqlardan birini tanlang:\n";
        $text .= "/list - Bor tasklar ro'yxati\n";
        $text .= "/add - Task qo'shish\n";
        $text .= "/delete - Taskni o'chirish\n";
        $text .= "/done - Taskni bajarilgan qilib belgilash\n";
        $text .= "/undone - Taskni bajarilmagan qilib belgilash";

        $this->sendMessage($text);
    }

    private function handleListCommand(): void {
        $tasks = (new Todo())->getTasks();

        if (empty($tasks)) {
            $this->sendMessage("Hozircha tasklar mavjud emas.");
            return;
        }

        $taskList = "Tasklar ro'yxati:\n\n";
        foreach ($tasks as $task) {
            $status = $task['status'] ? ' ' : ' ';
            $taskList .= "{$status} {$task['task']}\n";
        }

        $this->sendMessage($taskList);
    }

    private function handleUnknownCommand(): void {
        $this->sendMessage("Noma'lum buyruq. /start ni bosing.");
    }

    private function sendMessage(string $text): void {
        $this->http->post('sendMessage', [
            'form_params' => [
                'chat_id' => $this->chatId,
                'text'    => $text,
            ],
        ]);
    }

    public function setWebhook(string $url): string {
        try {
            $response = $this->http->post('setWebhook', [
                'form_params' => [
                    'url'                  => $url,
                    'drop_pending_updates' => true,
                ],
            ]);

            $response = json_decode($response->getBody()->getContents(), true);
            return $response['description'];
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}