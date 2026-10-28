<?php

namespace App\Logging;

use Monolog\Formatter\LineFormatter;
use Monolog\LogRecord;

class CustomFormatter extends LineFormatter
{
    public function format(LogRecord $record): string
    {
        $datetime = $record->datetime->format('Y-m-d H:i:s');
        $level = strtoupper($record->level->getName());
        $channel = $record->channel;
        $message = $record->message;

        $context = '';
        if (!empty($record->context)) {
            $context = ' | Context: ' . json_encode($record->context, JSON_PRETTY_PRINT);
        }

        $extra = '';
        if (!empty($record->extra)) {
            $extra = ' | Extra: ' . json_encode($record->extra, JSON_PRETTY_PRINT);
        }

        $color = $this->getColorForLevel($record->level->value);

        return sprintf(
            "%s [%s] %s.%s: %s%s%s\n",
            $datetime,
            $color,
            $channel,
            $level,
            $message,
            $context,
            $extra
        );
    }

    private function getColorForLevel(int $level): string
    {
        return match ($level) {
            100 => 'DEBUG',
            200 => 'INFO',
            250 => 'NOTICE',
            300 => 'WARNING',
            400 => 'ERROR',
            500 => 'CRITICAL',
            550 => 'ALERT',
            600 => 'EMERGENCY',
            default => 'UNKNOWN'
        };
    }
}
