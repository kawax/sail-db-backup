<?php

declare(strict_types=1);

namespace Revolution\Sail\Backup;

use Illuminate\Support\ServiceProvider;
use Revolution\Sail\Backup\Console\SailMySQLBackup;

class SailBackupServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if ($this->app->runningInConsole() && $this->app->isLocal()) {
            $this->commands([
                SailMySQLBackup::class,
            ]);
        }
    }
}
