<?php

namespace Tests\Feature;

use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

/**
 * Polish has three plural forms (1 / 2-4, 22-24... / everything else).
 * Laravel's MessageSelector picks index 0, 1 or 2 for "pl", and falls back to
 * the FIRST segment when the index is missing. Two-form Polish strings in
 * Filament therefore render the singular text for 5+ (e.g. "1 wiersz" for 10 rows).
 */
class PolishPluralTranslationsTest extends TestCase
{
    public static function cases(): array
    {
        return [
            'mfa code expiry, default 4 min' => ['filament-panels::auth/multi-factor/email/notifications/verify-email-authentication.lines.1', 4, ['minutes' => 4], 'Ten kod wygaśnie za 4 minuty.'],
            'mfa code expiry, 10 min' => ['filament-panels::auth/multi-factor/email/notifications/verify-email-authentication.lines.1', 10, ['minutes' => 10], 'Ten kod wygaśnie za 10 minut.'],
            'export max rows, 10' => ['filament-actions::export.notifications.max_rows.body', 10, ['count' => 10], 'Nie możesz wyeksportować więcej niż 10 wierszy na raz.'],
            'export started, 3' => ['filament-actions::export.notifications.started.body', 3, ['count' => 3], 'Rozpoczęto eksport i 3 wiersze zostaną przetworzone w tle.'],
            'export started, 25' => ['filament-actions::export.notifications.started.body', 25, ['count' => 25], 'Rozpoczęto eksport i 25 wierszy zostanie przetworzonych w tle.'],
            'import max rows, 10' => ['filament-actions::import.notifications.max_rows.body', 10, ['count' => 10], 'Nie możesz zaimportować więcej niż 10 wierszy na raz.'],
            'import started, 3' => ['filament-actions::import.notifications.started.body', 3, ['count' => 3], 'Import rozpoczęty i 3 wiersze zostaną przetworzone w tle.'],
            'unread notifications, 2' => ['filament-panels::layout.actions.open_database_notifications.label_with_unread_count', 2, ['count' => 2], 'Powiadomienia, 2 nieprzeczytane'],
            'actions column label, 5' => ['filament-tables::table.columns.actions.label', 5, [], 'Akcje'],
            'table result count, 3' => ['filament-tables::table.result_count', 3, ['count' => 3], '3 wyniki'],
        ];
    }

    #[DataProvider('cases')]
    public function test_polish_plural_forms(string $key, int $number, array $replace, string $expected): void
    {
        $this->assertSame($expected, trans_choice($key, $number, $replace, 'pl'));
    }
}
