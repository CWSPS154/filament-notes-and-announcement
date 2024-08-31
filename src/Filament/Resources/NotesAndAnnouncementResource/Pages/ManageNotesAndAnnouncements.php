<?php

namespace CWSPS154\FilamentNotesAndAnnouncement\Filament\Resources\NotesAndAnnouncementResource\Pages;

use CWSPS154\FilamentNotesAndAnnouncement\Filament\Resources\NotesAndAnnouncementResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageNotesAndAnnouncements extends ManageRecords
{
    protected static string $resource = NotesAndAnnouncementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
