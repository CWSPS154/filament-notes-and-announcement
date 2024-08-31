<?php
/*
 * Copyright CWSPS154. All rights reserved.
 * @auth CWSPS154
 * @link  https://github.com/CWSPS154
 */

namespace CWSPS154\FilamentNotesAndAnnouncement\Database\Seeders;

use CWSPS154\FilamentUsersRolesPermissions\Models\Permission;
use Illuminate\Database\Seeder;

class NotesAndAnnouncementPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $id = Permission::create([
            'name' => 'Notes And Announcement',
            'identifier' => 'notes-and-announcement',
            'route' => null,
            'parent_id' => null,
            'status' => true
        ])->id;

        Permission::create([
            'name' => 'View Notes And Announcement',
            'identifier' => 'view-notes-and-announcement',
            'route' => 'filament.admin.resources.notes-and-announcements.index',
            'parent_id' => $id,
            'status' => true
        ]);

        Permission::create([
            'name' => 'Create Notes And Announcement',
            'identifier' => 'create-notes-and-announcement',
            'route' => null,
            'parent_id' => $id,
            'status' => true
        ]);

        Permission::create([
            'name' => 'Edit Notes And Announcement',
            'identifier' => 'edit-notes-and-announcement',
            'route' => null,
            'parent_id' => $id,
            'status' => true
        ]);

        Permission::create([
            'name' => 'Delete Notes And Announcement',
            'identifier' => 'delete-notes-and-announcement',
            'route' => null,
            'parent_id' => $id,
            'status' => true
        ]);
    }
}
