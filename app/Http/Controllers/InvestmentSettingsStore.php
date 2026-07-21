<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class InvestmentSettingsStore
{
    private const PATH = 'investment-settings.json';

    public static function defaults(): array
    {
        return [
            'hero_title' => 'Invest in LVIGS MART and join the next growth phase.',
            'hero_text' => 'Select an investment slab, submit your details, complete payment, and receive a clean digital receipt through a focused investor workflow.',
            'gallery_title' => 'LVIGS MART investment gallery',
            'gallery_text' => 'Admin can upload an image here for investor presentation and brand visibility.',
            'membership_title' => 'Become an LVIGS MART investment member.',
            'membership_text' => 'Membership starts with choosing a plan, submitting investor details, and completing the payment receipt flow.',
            'image_path' => null,
        ];
    }

    public static function get(): array
    {
        if (! Storage::disk('local')->exists(self::PATH)) {
            return self::defaults();
        }

        $settings = json_decode(Storage::disk('local')->get(self::PATH), true);

        if (! is_array($settings)) {
            return self::defaults();
        }

        return array_merge(self::defaults(), $settings);
    }

    public static function save(array $settings): void
    {
        Storage::disk('local')->put(self::PATH, json_encode(array_merge(self::get(), $settings), JSON_PRETTY_PRINT));
    }
}
