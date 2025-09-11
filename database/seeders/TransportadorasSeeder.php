<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TransportadorasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $transportadoras = [];
        
        // Nomes de transportadoras da região metropolitana do ES
        $nomesTransportadoras = [
            // Serra
            'Expresso Serra Logística', 'TransSerra Transportes', 'Cargas Serra Express',
            'Serra Logistics', 'Rapidão Serra', 'Via Serra Transportes',
            'Central Logística Serra', 'Norte Sul Transportes Serra', 'Litoral Express Serra',
            'Metropolitana Cargas Serra',
            
            // Vitória
            'Expresso Vitória Logística', 'Transcol Transportes', 'ES Cargas Express',
            'Vitória Logistics', 'Central Logística ES', 'Vitória Express',
            'Transoceânica Transportes', 'Marítima Capixaba', 'Vitória Marítima',
            'Porto de Vitória Transportes',
            
            // Cariacica
            'Cariacica Express', 'TransCariacica Log', 'Cargas Cariacica',
            'Expresso Campo Grande', 'Via Cariacica Transportes', 'Central Cariacica Log',
            'Rapidão Cariacica', 'Cariacica Road Logistics',
            
            // Vila Velha
            'Vila Velha Log', 'Expresso Vila Velha', 'TransVila Transportes',
            'Cargas Vila Velha', 'Praia Logistics', 'Coqueiral Transportes',
            'Vila Velha Express', 'Litoral Vila Velha'
        ];
        
        // Bairros por cidade
        $bairros = [
            'Serra' => ['Jardim Limoeiro', 'Nova Carapina', 'Feu Rosa', 'Jardim Tropical', 
                       'Civit', 'Serra Dourada', 'Laranjeiras', 'Parque Residencial Nova Almeida',
                       'Centro da Serra', 'Jardim Carapina'],
            'Vitória' => ['Jardim Camburi', 'Praia do Canto', 'Enseada do Suá', 'Santa Lúcia', 
                         'Jardim da Penha', 'Mata da Praia', 'Bento Ferreira', 'Goiabeiras',
                         'Maria Ortiz', 'Santos Dumont'],
            'Cariacica' => ['Campo Grande', 'Vila Capixaba', 'Jardim América', 'Dom Bosco',
                           'Santo Antônio', 'Vila Palestina', 'Flexal', 'Porto de Santana',
                           'Itacibá', 'São Francisco'],
            'Vila Velha' => ['Praia da Costa', 'Itapuã', 'Coqueiral de Itaparica', 'Glória',
                            'Soteco', 'Jardim Guaranhuns', 'Paul', 'Vila Garrido',
                            'Santa Mônica', 'Ataíde']
        ];
        
        // Logradouros comuns
        $logradouros = ['Avenida', 'Rua', 'Rodovia', 'Praça', 'Travessa', 'Alameda'];
        $nomesRuas = [
            'Brasil', 'Espírito Santo', 'Vitória', 'Serra', 'Cariacica', 'Vila Velha',
            'São Paulo', 'Rio de Janeiro', 'Minas Gerais', 'Bahia', 
            'das Flores', 'dos Girassóis', 'das Palmeiras', 'dos Coqueiros',
            'Principal', 'Central', 'Nacional', 'Estadual', 'Municipal',
            'Dante Michelini', 'Fernando Ferrari', 'Marechal Campos', 'Nossa Senhora da Penha'
        ];

        for ($i = 0; $i < 30; $i++) {
            $nome = $nomesTransportadoras[$i];
            $email = strtolower(str_replace(' ', '.', preg_replace('/[^a-zA-Z0-9]/', '', $nome))) . '@transportadora.com';
            
            // Distribui entre as cidades da região metropolitana
            $cidades = ['Serra', 'Vitória', 'Cariacica', 'Vila Velha'];
            $cidade = $cidades[$i % 4];
            $estado = 'ES';
            
            $bairro = $bairros[$cidade][array_rand($bairros[$cidade])];
            $logradouro = $logradouros[array_rand($logradouros)] . ' ' . $nomesRuas[array_rand($nomesRuas)];
            
            // CEPs reais da região metropolitana do ES
            $ceps = [
                'Serra' => ['29160', '29161', '29162', '29163', '29164', '29165', '29166', '29167', '29168', '29169'],
                'Vitória' => ['29010', '29015', '29020', '29025', '29030', '29035', '29040', '29045', '29050', '29055'],
                'Cariacica' => ['29140', '29141', '29142', '29143', '29144', '29145', '29146', '29147', '29148', '29149'],
                'Vila Velha' => ['29100', '29101', '29102', '29103', '29104', '29105', '29106', '29107', '29108', '29109']
            ];
            
            $cepBase = $ceps[$cidade][array_rand($ceps[$cidade])];
            $cep = $cepBase . '-' . rand(100, 999);
            
            $transportadoras[] = [
                'nome' => $nome,
                'tipoPessoa' => 'J', // J para pessoa jurídica
                'documento' => $this->gerarCnpj(),
                'endereco' => $logradouro,
                'numero' => rand(10, 9999),
                'complemento' => rand(0, 1) ? 'Sala ' . rand(100, 999) : 'Galpão ' . rand(1, 50),
                'bairro' => $bairro,
                'cidade' => $cidade,
                'estado' => $estado,
                'cep' => $cep,
                'email' => $email,
                'telefone' => '(27) ' . rand(3000, 3999) . '-' . rand(1000, 9999),
                'ativo' => 1, // Todas transportadoras ativas
                'maxtradeId' => rand(100000, 999999),
                'created_at' => Carbon::now()->subDays(rand(1, 730)),
                'updated_at' => Carbon::now(),
            ];
        }

        // Insere todas as transportadoras de uma vez
        DB::table('transportadora')->insert($transportadoras);
        
        $this->command->info('30 transportadoras da região metropolitana do ES foram criadas com sucesso!');
        $this->command->info('Cidades: Serra, Vitória, Cariacica e Vila Velha');
    }
    
    /**
     * Gera um CNPJ válido
     */
    private function gerarCnpj(): string
    {
        // Gera os primeiros 8 dígitos aleatórios
        $primeirosDigitos = '';
        for ($i = 0; $i < 8; $i++) {
            $primeirosDigitos .= rand(0, 9);
        }
        
        // Adiciona 0001 para representar a matriz
        $base = $primeirosDigitos . '0001';
        
        // Calcula primeiro dígito verificador
        $pesos1 = [5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];
        $soma = 0;
        for ($i = 0; $i < 12; $i++) {
            $soma += $base[$i] * $pesos1[$i];
        }
        $resto = $soma % 11;
        $digito1 = ($resto < 2) ? 0 : 11 - $resto;
        
        // Calcula segundo dígito verificador
        $pesos2 = [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];
        $soma = 0;
        for ($i = 0; $i < 12; $i++) {
            $soma += $base[$i] * $pesos2[$i];
        }
        $soma += $digito1 * $pesos2[12];
        $resto = $soma % 11;
        $digito2 = ($resto < 2) ? 0 : 11 - $resto;
        
        return $base . $digito1 . $digito2;
    }
}