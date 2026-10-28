<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ViewLogs extends Command
{
    protected $signature = 'logs:view {type=all : Log type (all, error, estimation, laravel)} {--lines=50 : Number of lines to show}';

    protected $description = 'View application logs in a human-readable format';

    public function handle()
    {
        $type = $this->argument('type');
        $lines = $this->option('lines');

        $logFiles = $this->getLogFiles($type);

        if (empty($logFiles)) {
            $this->error('No log files found for type: ' . $type);
            return;
        }

        foreach ($logFiles as $logFile) {
            $this->info("=== {$logFile} ===");
            $this->displayLogFile($logFile, $lines);
            $this->line('');
        }
    }

    private function getLogFiles($type)
    {
        $logPath = storage_path('logs');
        $files = [];

        switch ($type) {
            case 'error':
                $files = File::glob($logPath . '/error*.log');
                break;
            case 'estimation':
                $files = File::glob($logPath . '/estimation*.log');
                break;
            case 'laravel':
                $files = File::glob($logPath . '/laravel*.log');
                break;
            case 'all':
            default:
                $files = File::glob($logPath . '/*.log');
                break;
        }

        return $files;
    }

    private function displayLogFile($filePath, $lines)
    {
        if (!File::exists($filePath)) {
            $this->warn("Log file does not exist: {$filePath}");
            return;
        }

        $content = File::get($filePath);
        $logLines = explode("\n", $content);
        $logLines = array_filter($logLines);

        $recentLines = array_slice($logLines, -$lines);

        foreach ($recentLines as $line) {
            $this->line($line);
        }
    }
}
