<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // Execute NA ORDEM que precisar
            UsersSeeder::class,
            ClientesSeeder::class,
            TransportadorasSeeder::class,
            OperacoesSeeder::class,
            OperacoesGradesSeeder::class,
        ]);
    }
}
