<?php

namespace WestmSchools\HelloWizardOfOz;

use App\Models\Setting;

/**
 * The quote list: one quote per line, saved in Settings. Falls back to DEFAULTS until an admin saves a list.
 */
class Quotes
{
    public const KEY = 'hello-wizard-of-oz.quotes';

    public const DEFAULTS = [
        'There\'s no place like home.',
        'Toto, I\'ve a feeling we\'re not in Kansas anymore.',
        'Lions and tigers and bears, oh my!',
        'Follow the Yellow Brick Road.',
        'Pay no attention to that man behind the curtain!',
        'I\'ll get you, my pretty, and your little dog too!',
        'If I only had a brain.',
        'Surrender Dorothy.',
        'You\'re off to see the Wizard, the wonderful Wizard of Oz.',
        'Oh, I\'m a very good man. I\'m just a very bad wizard.',
        'A heart is not judged by how much you love, but by how much you are loved by others.',
        'I\'m melting!',
    ];

    /** @return list<string> */
    public static function all(): array
    {
        $saved = Setting::get(self::KEY);

        return $saved === null ? self::DEFAULTS : self::parse($saved);
    }

    public static function random(): ?string
    {
        $quotes = self::all();

        return $quotes ? $quotes[array_rand($quotes)] : null;
    }

    /** @return list<string> */
    public static function parse(string $text): array
    {
        return array_values(array_filter(array_map('trim', preg_split('/\R/', $text)), fn ($line) => $line !== ''));
    }
}
