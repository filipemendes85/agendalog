<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ClientesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clientes = [];
        
        // Empresas da região metropolitana do ES
        $empresas = [
            // Serra
            'Metalúrgica Serra Sul', 'Comércio de Materiais Construção Serra', 'Transportes Serra Ltda',
            'Supermercados Serra', 'Mecânica Automotiva Serra', 'Construtora Serra Norte',
            'Distribuidora de Bebidas Serra', 'Posto de Combustíveis Serra', 'Loja de Móveis Serra',
            'Clínica Médica Serra', 'Escritório Contábil Serra', 'Restaurante Sabor Serra',
            
            // Vitória
            'Advocacia Vitória Associados', 'Consultoria Empresarial Vitória', 'Hotel Vitória Palace',
            'Construtora Vitória Civil', 'Comércio Varejista Vitória', 'Escritório Arquitetura Vitória',
            'Clínica Odontológica Vitória', 'Laboratório Análises Vitória', 'Academia Vitória Fitness',
            'Loja de Eletrônicos Vitória', 'Concessionária Vitória Motors', 'Shopping Vitória Center',
            
            // Cariacica
            'Indústria de Plásticos Cariacica', 'Transportes Cariacica Ltda', 'Distribuidora Cariacica',
            'Materiais Elétricos Cariacica', 'Supermercado Cariacica', 'Oficina Mecânica Cariacica',
            'Farmácia Cariacica', 'Padaria Pão Quente Cariacica', 'Loja de Roupas Cariacica',
            'Posto de Saúde Cariacica', 'Escola Técnica Cariacica', 'Restaurante Cariacica',
            
            // Vila Velha
            'Comércio Vila Velha', 'Construtora Vila Velha', 'Hotel Praia de Vila Velha',
            'Restaurante Beira Mar Vila Velha', 'Academia Vila Velha', 'Loja de Surf Vila Velha',
            'Clínica Veterinária Vila Velha', 'Supermercado Vila Velha', 'Auto Peças Vila Velha',
            'Escritório de Engenharia Vila Velha', 'Transporte Turístico Vila Velha', 'Confeitaria Vila Velha'
        ];
        
        // Bairros por cidade
        $bairros = [
            'Serra' => ['Centro da Serra', 'Jardim Limoeiro', 'Nova Carapina', 'Feu Rosa', 'Jardim Tropical', 'Parque Residencial Laranjeiras', 'Civit', 'Santo Antônio'],
            'Vitória' => ['Centro de Vitória', 'Jardim da Penha', 'Praia do Canto', 'Enseada do Suá', 'Santa Lúcia', 'Jardim Camburi', 'Mata da Praia', 'Bento Ferreira'],
            'Cariacica' => ['Campo Grande', 'Vila Palestina', 'Porto de Santana', 'São Francisco', 'Vila Capixaba', 'Dom Bosco', 'Itacibá', 'Vila Prudêncio'],
            'Vila Velha' => ['Centro de Vila Velha', 'Praia da Costa', 'Itapuã', 'Coqueiral de Itaparica', 'Glória', 'Santa Mônica', 'Soteco', 'Ataíde']
        ];
        
        // Logradouros comuns
        $logradouros = ['Avenida', 'Rua', 'Rodovia', 'Praça', 'Travessa', 'Alameda'];
        $nomesRuas = [
            'Brasil', 'Espírito Santo', 'Vitória', 'Serra', 'Cariacica', 'Vila Velha',
            'São Paulo', 'Rio de Janeiro', 'Minas Gerais', 'Bahia', 'Paraná', 'Santa Catarina',
            'das Flores', 'dos Girassóis', 'das Palmeiras', 'dos Coqueiros', 'do Comércio', 'Industrial',
            'Principal', 'Central', 'Nacional', 'Estadual', 'Municipal'
        ];

        for ($i = 0; $i < 30; $i++) {
            $empresa = $empresas[$i];
            $email = strtolower(str_replace(' ', '.', preg_replace('/[^a-zA-Z0-9]/', '', $empresa))) . '@empresa.com';
            
            // Distribui entre as cidades da região metropolitana
            $cidade = ['Serra', 'Vitória', 'Cariacica', 'Vila Velha'][$i % 4];
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
            
            $clientes[] = [
                'nome' => $empresa,
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
                'ativo' => 1, // Todas empresas ativas
                'maxtradeId' => rand(100000, 999999),
                'created_at' => Carbon::now()->subDays(rand(1, 730)),
                'updated_at' => Carbon::now(),
            ];
        }

        // Insere todos os clientes de uma vez
        DB::table('cliente')->insert($clientes);
        
        $this->command->info('30 empresas da região metropolitana do ES foram criadas com sucesso!');
        $this->command->info('Cidades: Serra, Vitória, Cariacica e Vila Velha');
    }
    
    /**
     * Gera um CNPJ válido
     */
    private function gerarCnpj(): string
    {
        $noveDigitos = '';
        for ($i = 0; $i < 8; $i++) {
            $noveDigitos .= rand(0, 9);
        }
        $noveDigitos .= '0001'; // Filial 0001
        
        // Calcula primeiro dígito verificador
        $pesos = [5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];
        $soma = 0;
        for ($i = 0; $i < 12; $i++) {
            $soma += $noveDigitos[$i] * $pesos[$i];
        }
        $resto = $soma % 11;
        $digito1 = ($resto < 2) ? 0 : 11 - $resto;
        
        // Calcula segundo dígito verificador
        $pesos = [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];
        $soma = 0;
        for ($i = 0; $i < 12; $i++) {
            $soma += $noveDigitos[$i] * $pesos[$i];
        }
        $soma += $digito1 * $pesos[12];
        $resto = $soma % 11;
        $digito2 = ($resto < 2) ? 0 : 11 - $resto;
        
        return $noveDigitos . $digito1 . $digito2;
    }
}