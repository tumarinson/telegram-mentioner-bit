<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use App\Helpers\AvailableTelegramMethods as TelegramMethods;

final class TelegramBotService
{
    const MENTIONER_BOT_ENDPOINT = 'https://api.telegram.org/bot5233399966:AAHXQG9lk-8UGeO8tSOY5W4fPzhJ3McHaqs/'; // pls dont hack me

    public function processCommand(Request $request)
    {
        $message = $request->get('message');

        $chatId = Arr::get($message, 'chat.id');

        $text = Arr::get($message, 'text');
        $explodedCommand = explode(' ', $text);

        $command = $explodedCommand[0];
        $command = trim(\Illuminate\Support\Str::replace('@team_mentioner_bot', '', $command));

        unset($explodedCommand[0]);
        $explodedCommand = array_values($explodedCommand);

        switch ($command) {
            case '/mention':
                $text = MentionService::mention($chatId, $explodedCommand);
                break;
            case '/creategroup':
                $text = GroupService::createGroup($chatId, $explodedCommand);
                break;
            case '/deletegroup':
                $text = GroupService::deleteGroup($chatId, $explodedCommand);
                break;
            case '/addmembertogroup':
                $text = GroupMemberService::addMembersToGroup($chatId, $explodedCommand);
                break;
            case '/removememberfromgroup':
                $text = GroupMemberService::removeMembersFromGroup($chatId, $explodedCommand);
                break;
            case '/start':
                $text = 'Mentioner bot is activated';
                break;
            case '/help':
                $text = ''; // todo
                break;
            default:
                $text = "Command {$command} not found";
        }

        return $this->sendMessage($chatId, $text);
    }

    public function sendMessage(int $chatId, string $message): \Illuminate\Http\Client\Response
    {
        $endpointForSendingMessage = self::MENTIONER_BOT_ENDPOINT . TelegramMethods::SEND_MESSAGE_METHOD;

        return Http::post($endpointForSendingMessage, ['chat_id' => $chatId, 'text' => $message]);
    }

    public function getMe(): \Illuminate\Http\Client\Response // todo phpunit test health check
    {
        return Http::get(self::MENTIONER_BOT_ENDPOINT . TelegramMethods::GET_BOT_STATUS_METHOD);
    }
}
