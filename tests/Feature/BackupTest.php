<?php

declare(strict_types=1);

namespace Tests\Feature;

use Carbon\Carbon;
use Illuminate\Contracts\Process\ProcessResult;
use Illuminate\Process\PendingProcess;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Process;
use Tests\TestCase;

class BackupTest extends TestCase
{
    public function test_backup()
    {
        Process::fake();

        $this->freezeTime(function (Carbon $time) {
            $time->setDateTime(2023, 2, 26, 0, 0, 0);

            $this->artisan('sail:backup:mysql')
                 ->assertSuccessful()
                 ->expectsOutput('Backing up mysql database test-202302260000.sql');
        });

        Process::assertRan(fn (
            PendingProcess $process,
            ProcessResult $result,
        ) => collect($process->command)->contains('--result-file='.App::basePath('mysql_backup/test-202302260000.sql')));
    }

    public function test_backup_with_path()
    {
        Process::fake();

        $this->freezeTime(function (Carbon $time) {
            $time->setDateTime(2023, 2, 26, 0, 0, 0);

            $this->artisan('sail:backup:mysql', ['--path' => 'mysql'])
                 ->assertSuccessful()
                 ->expectsOutput('Backing up mysql database test-202302260000.sql');
        });

        Process::assertRan(fn (
            PendingProcess $process,
            ProcessResult $result,
        ) => collect($process->command)->contains('--result-file='.App::basePath('mysql/test-202302260000.sql')));
    }
}
