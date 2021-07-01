<?php

declare(strict_types=1);

namespace Revolution\Sail\Backup;

use Illuminate\Support\ServiceProvider;
use Revolution\Sail\Backup\Console\SailMySQLBackup;

class SailBackupServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                SailMySQLBackup::class,
            ]);
        }
    }
}
