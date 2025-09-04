<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tenants')->insert([
            [
                'id' => 1, 
                'nome_empresa' => 'Empresa Default',
                'plano' => 'basico',
                'status' => 'ativo'
            ],
        ]);
    }
}