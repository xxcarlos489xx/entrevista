<?php
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class OperadorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'nombres' => 'Operado T-Kambio',
            'role_id' => 2,
            'estado' => 1,
            'email' => 'operador@tkambio.com',
            'remember_token' => Str::random(10),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);
    }
}
