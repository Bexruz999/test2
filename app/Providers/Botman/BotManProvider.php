<?php

namespace App\Providers\BotMan;

use BotMan\BotMan\Drivers\DriverManager;
use App\Services\BotMan\TelegramDriver;
use BotMan\BotMan\BotManServiceProvider as ServiceProvider;

class BotManProvider extends ServiceProvider
{
    /**
     * The drivers that should be loaded to
     * use with BotMan
     *
     * @var array
     */
    protected $drivers = [
        TelegramDriver::class
    ];

    /**
     * @return void
     */
    public function boot()
    {
        parent::boot();

        foreach ($this->drivers as $driver) {
            DriverManager::loadDriver($driver);
        }

        DriverManager::loadDriver(\BotMan\Drivers\Telegram\TelegramDriver::class);

        BotManFactory::create($config);
    }
}
