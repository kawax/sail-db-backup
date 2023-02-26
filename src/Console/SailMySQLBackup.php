<?php

declare(strict_types=1);

namespace Revolution\Sail\Backup\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Process;

class SailMySQLBackup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sail:backup:mysql {--path=mysql_backup}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Backup Sail's MySQL";

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $host = Config::get('database.connections.mysql.host');
        $port = Config::get('database.connections.mysql.port');
        $username = Config::get('database.connections.mysql.username');
        $password = Config::get('database.connections.mysql.password');
        $database = Config::get('database.connections.mysql.database');

        $now = Carbon::now()->format('YmdHi');
        $path = App::basePath($this->option('path'));

        File::ensureDirectoryExists($path);

        $cmd = [
            'mysqldump',
            "--host=$host",
            "--port=$port",
            "--user=$username",
            "--password=$password",
            $database,
            "--result-file=$path/$database-$now.sql",
        ];

        Process::run($cmd);

        $this->info("Backing up mysql database $database-$now.sql");

        return 0;
    }
}
