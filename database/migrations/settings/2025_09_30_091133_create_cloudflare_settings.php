<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('cloudflare.enabled', false);
        $this->migrator->add('cloudflare.site_key', '');
        $this->migrator->addEncrypted('cloudflare.site_secret', '');
    }

    public function down()
    {
        $this->migrator->delete('cloudflare.enabled');
        $this->migrator->delete('cloudflare.site_key');
        $this->migrator->delete('cloudflare.site_secret');
    }
};
