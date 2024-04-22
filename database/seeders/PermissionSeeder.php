<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'create task']);
        Permission::create(['name' => 'edit task']);

        $role1 = Role::create(['name' => 'member']);
        $role1->givePermissionTo('create task');

        $role2 = Role::create(['name' => 'admin']);
        $role2->givePermissionTo('edit task');

        $user = \App\Models\User::factory()->create([
            'name' => 'User Member',
            'email' => 'member@example.com',
        ]);

        $user->assignRole($role1);

        $user = \App\Models\User::factory()->create([
            'name' => 'User Admin',
            'email' => 'admin@example.com',
        ]);

        $user->assignRole($role2);
    }
}
