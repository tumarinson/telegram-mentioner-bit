<?php

namespace App\Http\Controllers;

use App\Services\TelegramBotService;
use Illuminate\Http\Request;

final class TelegramBotController extends Controller
{
    private $telegramBotService;

    public function __construct(TelegramBotService $telegramBotService)
    {
        $this->telegramBotService = $telegramBotService;
    }

    public function index(Request $request)
    {
        return $this->telegramBotService->processCommand($request);
    }

    public function getMe()
    {
        return $this->telegramBotService->getMe();
    }
}
