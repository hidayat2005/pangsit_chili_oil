<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class TestPostgreSQLConnection extends Command
{
    protected $signature = 'test:pgsql';
    protected $description = 'Test PostgreSQL connection';

    public function handle()
    {
        try {
            $pdo = DB::connection()->getPdo();
            $this->info("✅ SUCCESS: Connected to PostgreSQL!");
            $this->info("Database: " . DB::connection()->getDatabaseName());
            $this->info("Driver: " . $pdo->getAttribute(\PDO::ATTR_DRIVER_NAME));
            return 0;
        } catch (\Exception $e) {
            $this->error("❌ ERROR: " . $e->getMessage());
            return 1;
        }
    }
}