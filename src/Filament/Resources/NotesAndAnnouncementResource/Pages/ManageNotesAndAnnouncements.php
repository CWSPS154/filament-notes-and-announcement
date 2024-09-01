<?php

namespace CWSPS154\FilamentNotesAndAnnouncement\Filament\Resources\NotesAndAnnouncementResource\Pages;

use CWSPS154\FilamentNotesAndAnnouncement\Filament\Resources\NotesAndAnnouncementResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;
use Illuminate\Contracts\Support\Htmlable;

class ManageNotesAndAnnouncements extends ManageRecords
{
    protected static string $resource = NotesAndAnnouncementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label(__(config('filament-notes-and-announcement.navigation.buttons.create'))),
        ];
    }

    public function getTitle(): string|Htmlable
    {
        return __(config('filament-notes-and-announcement.navigation.title'));
    }
}
