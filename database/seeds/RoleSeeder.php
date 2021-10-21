<?php

use App\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            'Administrator',
            'Operador'
        ];

        foreach ($roles as $rol) {
            Role::create([
                'tipo' => $rol
            ]);
        }
    }
}
