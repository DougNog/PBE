<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // =========================================================
        // USUÁRIOS
        // =========================================================
        $admin = User::create([
            'name'     => 'Coordenadora SAFE',
            'email'    => 'admin@safe.edu.br',
            'password' => Hash::make('password'),
            'role'     => 'admin',
        ]);
        $porteiro = User::create([
            'name'     => 'Carlos Porteiro',
            'email'    => 'porteiro@safe.edu.br',
            'password' => Hash::make('password'),
            'role'     => 'porteiro',
        ]);
        User::create([
            'name'     => 'Prof. Samuel',
            'email'    => 'samuel@safe.edu.br',
            'password' => Hash::make('password'),
            'role'     => 'professor',
        ]);

        /*
        |---------------------------------------------------------------
        | DADOS DE DEMONSTRAÇÃO
        | Descomente este bloco para popular o banco com dados de teste.
        |---------------------------------------------------------------

        use App\Models\Aluno;
        use App\Models\Autorizacao;
        use App\Models\Movimentacao;
        use App\Models\Responsavel;

        [$r0, $r1, $r2, $r3, $r4, $r5, $r6, $r7, $r8, $r9] = collect([
            ['Maria Silva',       'maria.silva@email.com',       '(11) 99111-2222'],
            ['João Silva',        'joao.silva@email.com',        '(11) 99333-4444'],
            ['Carla Souza',       'carla.souza@email.com',       '(11) 98555-6666'],
            ['Ricardo Souza',     'ricardo.souza@email.com',     '(11) 98777-8888'],
            ['Fernanda Costa',    'fernanda.costa@email.com',    '(11) 97111-2222'],
            ['Roberto Costa',     'roberto.costa@email.com',     '(11) 97333-4444'],
            ['Aline Pereira',     'aline.pereira@email.com',     '(11) 96555-6666'],
            ['Marcos Pereira',    'marcos.pereira@email.com',    '(11) 96777-8888'],
            ['Patrícia Andrade',  'patricia.andrade@email.com',  '(11) 95111-2222'],
            ['Jorge Lima',        'jorge.lima@email.com',        '(11) 95333-4444'],
        ])->map(fn ($r) => Responsavel::create([
            'nome' => $r[0], 'email' => $r[1], 'telefone' => $r[2],
        ]))->all();

        $alunosData = [
            ['Pedro Silva',     '2026001', '3º Ano A',  [[$r0, 'Mãe'],  [$r1, 'Pai']]],
            ['Lucas Souza',     '2026002', '2º Ano B',  [[$r2, 'Mãe'],  [$r3, 'Pai']]],
            ['Isabela Costa',   '2026003', '3º Ano A',  [[$r4, 'Mãe'],  [$r5, 'Pai']]],
            ['Mariana Pereira', '2026004', '1º Ano C',  [[$r6, 'Mãe'],  [$r7, 'Pai']]],
            ['Gabriel Rocha',   '2026005', '2º Ano A',  [[$r8, 'Avó'],  [$r9, 'Tio']]],
            ['Sofia Andrade',   '2026006', '3º Ano B',  [[$r0, 'Mãe'],  [$r9, 'Tio']]],
            ['Rafael Oliveira', '2026007', '1º Ano A',  [[$r2, 'Mãe'],  [$r3, 'Pai']]],
            ['Beatriz Lima',    '2026008', '2º Ano B',  [[$r4, 'Mãe'],  [$r8, 'Avó']]],
            ['Davi Mendes',     '2026009', '1º Ano B',  [[$r6, 'Mãe'],  [$r7, 'Pai']]],
            ['Helena Rocha',    '2026010', '3º Ano A',  [[$r0, 'Mãe'],  [$r1, 'Pai'], [$r8, 'Avó']]],
        ];

        $alunos = collect();
        foreach ($alunosData as [$nome, $mat, $turma, $vinculos]) {
            $aluno = Aluno::create(['nome' => $nome, 'matricula' => $mat, 'turma' => $turma]);
            $pivot = [];
            foreach ($vinculos as [$resp, $parentesco]) {
                $pivot[$resp->id] = ['parentesco' => $parentesco];
            }
            $aluno->responsaveis()->attach($pivot);
            $alunos->push($aluno);
        }

        Autorizacao::create([
            'aluno_id'        => $alunos[0]->id,
            'responsavel_id'  => $r0->id,
            'aprovado_por'    => $admin->id,
            'tipo'            => 'saida', 'status' => 'ativa',
            'motivo'          => 'Consulta médica',
            'faltas'          => 2,
            'validade_inicio' => today()->setTime(14, 0),
            'validade_fim'    => today()->endOfDay(),
        ]);
        Autorizacao::create([
            'aluno_id'        => $alunos[2]->id,
            'responsavel_id'  => null,
            'aprovado_por'    => $admin->id,
            'tipo'            => 'saida', 'status' => 'ativa',
            'motivo'          => 'Consulta odontológica',
            'faltas'          => 1,
            'validade_inicio' => today()->setTime(10, 30),
            'validade_fim'    => today()->endOfDay(),
        ]);
        Autorizacao::create([
            'aluno_id'        => $alunos[4]->id,
            'responsavel_id'  => $r8->id,
            'aprovado_por'    => $admin->id,
            'tipo'            => 'saida', 'status' => 'expirada',
            'motivo'          => 'Apresentação cultural na escola',
            'faltas'          => 3,
            'validade_inicio' => today()->subDay()->setTime(13, 0),
            'validade_fim'    => today()->subDay()->endOfDay(),
        ]);
        Autorizacao::create([
            'aluno_id'        => $alunos[6]->id,
            'responsavel_id'  => $r2->id,
            'aprovado_por'    => $admin->id,
            'tipo'            => 'saida', 'status' => 'revogada',
            'motivo'          => 'Compromisso familiar (cancelado)',
            'faltas'          => 0,
            'validade_inicio' => today()->setTime(15, 0),
            'validade_fim'    => today()->endOfDay(),
        ]);

        foreach (range(1, 5) as $diasAtras) {
            $entrada = now()->subDays($diasAtras)->setTime(7, 30);
            foreach ($alunos->random(rand(6, 9)) as $aluno) {
                $t = $entrada->copy()->addMinutes(rand(0, 45));
                Movimentacao::create([
                    'aluno_id' => $aluno->id, 'registrado_por' => $porteiro->id,
                    'tipo' => 'entrada', 'created_at' => $t, 'updated_at' => $t,
                ]);
            }
            $saida = now()->subDays($diasAtras)->setTime(17, 0);
            foreach ($alunos->random(rand(5, 8)) as $aluno) {
                $t = $saida->copy()->addMinutes(rand(0, 60));
                Movimentacao::create([
                    'aluno_id' => $aluno->id, 'registrado_por' => $porteiro->id,
                    'tipo' => 'saida', 'created_at' => $t, 'updated_at' => $t,
                ]);
            }
        }

        */
    }
}
