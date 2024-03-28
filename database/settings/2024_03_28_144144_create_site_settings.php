<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('site.name', config('app.name'));
        $this->migrator->add('site.description', null);
        $this->migrator->add('site.logo', null);
    }
};
