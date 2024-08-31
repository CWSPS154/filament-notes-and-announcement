<?php

namespace CWSPS154\FilamentNotesAndAnnouncement\Filament\Resources;

use CWSPS154\FilamentNotesAndAnnouncement\Filament\Resources\NotesAndAnnouncementResource\Pages;
use CWSPS154\FilamentNotesAndAnnouncement\FilamentNotesAndAnnouncementServiceProvider;
use CWSPS154\FilamentNotesAndAnnouncement\Models\NotesAndAnnouncement;
use Filament\Facades\Filament;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;

class NotesAndAnnouncementResource extends Resource
{
    protected static ?string $model = NotesAndAnnouncement::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Toggle::make('status')
                    ->label(__('filament-notes-and-announcement::notes-and-announcement.status'))
                    ->live()
                    ->default(true),
//                Select::make('type')
//                    ->label(__('filament-notes-and-announcement::notes-and-announcement.type'))
//                    ->options([
//                        'notes' => __('filament-notes-and-announcement::notes-and-announcement.notes'),
//                        'announcement' => __('filament-notes-and-announcement::notes-and-announcement.announcement'),
//                    ])
//                    ->native(false)
//                    ->default('notes')
//                    ->required(),
                Hidden::make('type')->default('notes'),
                Textarea::make('body')
                    ->label(__('filament-notes-and-announcement::notes-and-announcement.body'))
                    ->rows(5)
                    ->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('body')
                    ->label(__('filament-notes-and-announcement::notes-and-announcement.body'))
                    ->searchable(),
                Tables\Columns\IconColumn::make('status')
                    ->width(1)
                    ->label(__('filament-notes-and-announcement::notes-and-announcement.status'))
                    ->boolean(),
            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageNotesAndAnnouncements::route('/'),
        ];
    }

    public function getLayout(): string
    {
        if (config('filament-notes-and-announcement.layout')) {
            return config('filament-notes-and-announcement.layout');
        }
        return parent::getLayout();
    }

    public static function getCluster(): ?string
    {
        return config('filament-notes-and-announcement.cluster');
    }

    public static function getNavigationLabel(): string
    {
        return __(config('filament-notes-and-announcement.navigation.label'));
    }

    public static function getNavigationIcon(): string|Htmlable|null
    {
        return config('filament-notes-and-announcement.navigation.icon');
    }

    public static function getNavigationGroup(): ?string
    {
        return __(config('filament-notes-and-announcement.navigation.group'));
    }

    public static function getNavigationSort(): ?int
    {
        return config('filament-notes-and-announcement.navigation.sort');
    }

    public static function checkAccess(string $method, Model $record = null): bool
    {
        $plugin = Filament::getCurrentPanel()?->getPlugin(FilamentNotesAndAnnouncementServiceProvider::$name);
        $access = $plugin->$method();
        if (!empty($access) && is_array($access) && isset($access['ability'], $access['arguments'])) {
            return Gate::allows($access['ability'], $access['arguments']);
        }

        return $access;
    }

    public static function canViewAny(): bool
    {
        return self::checkAccess('getCanViewAny');
    }

    public static function canCreate(): bool
    {
        return self::checkAccess('getCanCreate');
    }

    public static function canEdit(Model $record): bool
    {
        return self::checkAccess('getCanEdit', $record);
    }

    public static function canDelete(Model $record): bool
    {
        return self::checkAccess('getCanDelete', $record);
    }
}
