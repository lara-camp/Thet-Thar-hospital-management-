<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;

class DeleteMonthlyLogs extends Command
{
    protected $signature = 'logs:delete';
    protected $description = 'Delete log files older than one month';

    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $logPath = storage_path('logs');
        $files = File::files($logPath);

        $thirtyDaysAgo = Carbon::now()->subDays(30);

        foreach ($files as $file) {
            Log::info($file->getFilename());
            // Extract the date from the filename
            preg_match('/laravel-(\d{4}-\d{2}-\d{2})\.log/', $file->getFilename(), $matches);

            if (!empty($matches[1])) {
                Log::info($matches[1]);
                // Parse the extracted date from the filename
                $fileDate = Carbon::parse($matches[1]);
                Log::info($fileDate->lt($thirtyDaysAgo));
                // Compare file date to 30 days ago
                if ($fileDate->lt($thirtyDaysAgo)) {
                    File::delete($file);
                    $this->info('Deleted old log file: ' . $file->getFilename());
                }
            }
        }

        $this->info('Old log files deleted successfully.');
    }
}
