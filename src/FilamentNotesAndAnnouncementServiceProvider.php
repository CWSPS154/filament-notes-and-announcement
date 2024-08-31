<?php
/*
 * Copyright CWSPS154. All rights reserved.
 * @auth CWSPS154
 * @link  https://github.com/CWSPS154
 */

declare(strict_types=1);

namespace CWSPS154\FilamentNotesAndAnnouncement;

use CWSPS154\FilamentNotesAndAnnouncement\Database\Seeders\DatabaseSeeder;
use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentNotesAndAnnouncementServiceProvider extends PackageServiceProvider
{
    public static string $name = 'filament-notes-and-announcement';

    public function configurePackage(Package $package): void
    {
        $package->name(self::$name)
            ->hasConfigFile()
            ->hasViews()
            ->hasTranslations()
            ->hasMigrations(
                [
                    'create_notes_and_announcements_table'
                ]
            )
            ->hasInstallCommand(function (InstallCommand $command) {
                $command
                    ->startWith(function (InstallCommand $command) {
                        $command->info('Hi Mate, Thank you for installing My Package!');
                    })
                    ->publishConfigFile()
                    ->publishMigrations()
                    ->askToRunMigrations()
                    ->endWith(function (InstallCommand $command) {
                        if ($command->confirm('Do you wish to run the seeder for cwsps154/filament-users-roles-permissions ?')) {
                            $command->comment('The seeder is filled with "admin" as panel id, please check the route name for your panel');
                            $command->comment('Running seeder...');
                            $command->call('db:seed', [
                                'class' => DatabaseSeeder::class
                            ]);
                        }
                        $command->info('I hope this package will help you to build notes and announcement for the frontend user');
                    })
                    ->askToStarRepoOnGitHub('CWSPS154/filament-app-settings.git');
            });
    }
}
