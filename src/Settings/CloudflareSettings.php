<?php

namespace Astrogoat\Cloudflare\Settings;

use Helix\Lego\Settings\AppSettings;
use Illuminate\Validation\Rule;

class CloudflareSettings extends AppSettings
{
    public string $site_key;
    public string $site_secret;

    public function rules(): array
    {
        return [
            'site_key' => Rule::requiredIf($this->enabled === true),
            'site_secret' => Rule::requiredIf($this->enabled === true),
        ];
    }

    public static function encrypted(): array
    {
        return ['site_secret'];
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
