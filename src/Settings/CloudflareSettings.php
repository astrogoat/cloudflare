<?php

namespace Astrogoat\Cloudflare\Settings;

use Helix\Lego\Settings\AppSettings;
use Illuminate\Validation\Rule;

class CloudflareSettings extends AppSettings
{
    // public string $url;

    public function rules(): array
    {
        return [
//            'url' => Rule::requiredIf($this->enabled === true), // Example, modify to fit your need.
        ];
    }

    public function description(): string
    {
        return 'Interact with Cloudflare.';
    }

    public static function group(): string
    {
        return 'cloudflare';
    }
}
