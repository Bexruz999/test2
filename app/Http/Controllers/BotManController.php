<?php
namespace App\Http\Controllers;


use App\Http\Conversations\RealConversation;
use BotMan\BotMan\Drivers\DriverManager;
use BotMan\BotMan\BotManFactory;
use BotMan\Drivers\Telegram\TelegramDriver;
use BotMan\BotMan\BotMan;

class BotManController extends Controller
{
    /**
     * Place your BotMan logic here.
     */
    public function handle()
    {
        DriverManager::loadDriver(TelegramDriver::class);
      $config = [
           'telegram' => [
               'token' => config('telegram.token')
         ]
       ];

        $botman = BotManFactory::create($config);
        $botman = app('botman');
        $botman->hears('/start', function (Botman $bot) {
            $bot->startConversation(new RealConversation());

        })->stopsConversation();
        $botman->listen();
    }

    /**
     * Place your BotMan logic here.
     */

}
