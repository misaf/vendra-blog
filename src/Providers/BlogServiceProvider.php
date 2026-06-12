<?php

declare(strict_types=1);

namespace Misaf\VendraBlog\Providers;

use Filament\Panel;
use Illuminate\Foundation\Console\AboutCommand;
use Misaf\VendraBlog\BlogPlugin;
use Misaf\VendraBlog\Console\Commands\SeedCommand;
use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

final class BlogServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('vendra-blog')
            ->hasTranslations()
            ->hasMigrations([
                'create_blogs_table'
            ])
            ->hasCommands(SeedCommand::class)
            ->hasInstallCommand(function (InstallCommand $command): void {
                $command->askToStarRepoOnGitHub('misaf/vendra-blog');
            });
    }

    public function packageRegistered(): void
    {
        Panel::configureUsing(function (Panel $panel): void {
            if ('admin' !== $panel->getId()) {
                return;
            }

            $panel->plugin(BlogPlugin::make());
        });
    }

    public function packageBooted(): void
    {
        AboutCommand::add('Vendra Blog', fn() => ['Version' => 'dev-master']);
    }
}
