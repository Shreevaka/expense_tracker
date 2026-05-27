<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['name' => 'admin', 'guard_name' => 'web'],
            ['name' => 'user', 'guard_name' => 'web'],
        ];

        foreach ($roles as $key => $role) {

            $dataRow = Role::where('name', $role['name'])->first();

            if (!$dataRow) {
                $newModel = new Role;
                $newModel->name =  $role['name'];
                $newModel->guard_name = $role['guard_name'];
                $newModel->save();
            }
        }
    }
}
