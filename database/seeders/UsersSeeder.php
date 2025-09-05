<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'name' => 'João Silva',
                'email' => 'joao@teste.com',
                'password' => Hash::make('senha123'),
            ],
            [
                'name' => 'Maria Santos',
                'email' => 'maria@teste.com', 
                'password' => Hash::make('senha123'),
            ],
            [
                'name' => 'Pedro Oliveira',
                'email' => 'pedro@teste.com',
                'password' => Hash::make('senha123'),
            ],
            [
                'name' => 'Ana Costa',
                'email' => 'ana@teste.com',
                'password' => Hash::make('senha123'),
            ],
            [
                'name' => 'Carlos Souza',
                'email' => 'carlos@teste.com',
                'password' => Hash::make('senha123'),
            ],
            [
                'name' => 'Fernanda Lima',
                'email' => 'fernanda@teste.com',
                'password' => Hash::make('senha123'),
            ],
            [
                'name' => 'Ricardo Almeida',
                'email' => 'ricardo@teste.com',
                'password' => Hash::make('senha123'),
            ],
            [
                'name' => 'Camila Rodrigues',
                'email' => 'camila@teste.com',
                'password' => Hash::make('senha123'),
            ],
            [
                'name' => 'Bruno Costa',
                'email' => 'bruno@teste.com',
                'password' => Hash::make('senha123'),
            ],
            [
                'name' => 'Juliana Martins',
                'email' => 'juliana@teste.com',
                'password' => Hash::make('senha123'),
            ],
            [
                'name' => 'Paulo Ferreira',
                'email' => 'paulo@teste.com',
                'password' => Hash::make('senha123'),
            ],
            [
                'name' => 'Larissa Oliveira',
                'email' => 'larissa@teste.com',
                'password' => Hash::make('senha123'),
            ],
            [
                'name' => 'Marcos Santos',
                'email' => 'marcos@teste.com',
                'password' => Hash::make('senha123'),
            ],
            [
                'name' => 'Tatiane Souza',
                'email' => 'tatiane@teste.com',
                'password' => Hash::make('senha123'),
            ],
            [
                'name' => 'Rafael Mendes',
                'email' => 'rafael@teste.com',
                'password' => Hash::make('senha123'),
            ],
            [
                'name' => 'Patrícia Costa',
                'email' => 'patricia@teste.com',
                'password' => Hash::make('senha123'),
            ],
            [
                'name' => 'Diego Alves',
                'email' => 'diego@teste.com',
                'password' => Hash::make('senha123'),
            ],
            [
                'name' => 'Amanda Silva',
                'email' => 'amanda@teste.com',
                'password' => Hash::make('senha123'),
            ],
            [
                'name' => 'Leonardo Pereira',
                'email' => 'leonardo@teste.com',
                'password' => Hash::make('senha123'),
            ],
            [
                'name' => 'Carolina Santos',
                'email' => 'carolina@teste.com',
                'password' => Hash::make('senha123'),
            ],
            [
                'name' => 'Thiago Oliveira',
                'email' => 'thiago@teste.com',
                'password' => Hash::make('senha123'),
            ],
            [
                'name' => 'Vanessa Costa',
                'email' => 'vanessa@teste.com',
                'password' => Hash::make('senha123'),
            ],
            [
                'name' => 'Felipe Rodrigues',
                'email' => 'felipe@teste.com',
                'password' => Hash::make('senha123'),
            ],
            [
                'name' => 'Isabela Martins',
                'email' => 'isabela@teste.com',
                'password' => Hash::make('senha123'),
            ],
            [
                'name' => 'André Souza',
                'email' => 'andre@teste.com',
                'password' => Hash::make('senha123'),
            ],
            [
                'name' => 'Laura Ferreira',
                'email' => 'laura@teste.com',
                'password' => Hash::make('senha123'),
            ],
            [
                'name' => 'Gustavo Almeida',
                'email' => 'gustavo@teste.com',
                'password' => Hash::make('senha123'),
            ],
            [
                'name' => 'Beatriz Lima',
                'email' => 'beatriz@teste.com',
                'password' => Hash::make('senha123'),
            ],
            [
                'name' => 'Rodrigo Santos',
                'email' => 'rodrigo@teste.com',
                'password' => Hash::make('senha123'),
            ],
            [
                'name' => 'Mariana Oliveira',
                'email' => 'mariana@teste.com',
                'password' => Hash::make('senha123'),
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}