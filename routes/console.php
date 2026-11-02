<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('repro:pl-plurals', function () {
    $keys = [
        ['filament-panels::auth/multi-factor/email/notifications/verify-email-authentication.lines.1', 'minutes'],
        ['filament-actions::export.notifications.max_rows.body', 'count'],
        ['filament-actions::export.notifications.started.body', 'count'],
        ['filament-actions::import.notifications.max_rows.body', 'count'],
        ['filament-actions::import.notifications.started.body', 'count'],
        ['filament-panels::layout.actions.open_database_notifications.label_with_unread_count', 'count'],
        ['filament-tables::table.columns.actions.label', 'count'],
        ['filament-tables::table.result_count', 'count'],
    ];

    foreach ($keys as [$key, $param]) {
        $this->line('');
        $this->info($key);

        foreach ([1, 2, 4, 5, 10, 22] as $n) {
            $this->line(sprintf('  %3d => %s', $n, trans_choice($key, $n, [$param => $n], 'pl')));
        }
    }
})->purpose('Print Filament Polish plural strings for several numbers');
