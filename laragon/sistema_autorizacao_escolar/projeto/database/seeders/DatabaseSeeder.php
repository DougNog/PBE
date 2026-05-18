<?php

namespace Database\Seeders;

use App\Models\Aluno;
use App\Models\Autorizacao;
use App\Models\Movimentacao;
use App\Models\Responsavel;
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
        // USUÁRIOS — sempre criados no migrate:refresh --seed
        // =========================================================
        $admin = User::create([
            'name' => 'Admin SAFE',  'email' => 'admin@safe.edu.br',
            'password' => Hash::make('password'), 'role' => 'admin',
        ]);
        $porteiro = User::create([
            'name' => 'Carlos Porteiro', 'email' => 'porteiro@safe.edu.br',
            'password' => Hash::make('password'), 'role' => 'porteiro',
        ]);
        $professor = User::create([
            'name' => 'Prof. Ana Lima', 'email' => 'professor@safe.edu.br',
            'password' => Hash::make('password'), 'role' => 'professor',
        ]);
        $professor2 = User::create([
            'name' => 'Prof. Bruno Costa', 'email' => 'bruno@safe.edu.br',
            'password' => Hash::make('password'), 'role' => 'professor',
        ]);

        // =========================================================
        // DADOS DE DEMONSTRAÇÃO
        // Para popular responsáveis, alunos, autorizações e
        // movimentações de exemplo, descomente o bloco abaixo.
        // =========================================================

        /*

        // --- Responsáveis ----------------------------------------
        $resps = collect([
            ['Maria Silva',        'maria.silva@email.com',       '(11) 99111-2222'],
            ['João Silva',         'joao.silva@email.com',        '(11) 99333-4444'],
            ['Carla Souza',        'carla.souza@email.com',       '(11) 98555-6666'],
            ['Fernanda Costa',     'fernanda.costa@email.com',    '(11) 97777-8888'],
            ['Roberto Pereira',    'roberto.pereira@email.com',   '(11) 96666-1111'],
            ['Aline Rocha',        'aline.rocha@email.com',       '(11) 95555-2222'],
            ['Marcos Andrade',     'marcos.andrade@email.com',    '(11) 94444-3333'],
            ['Patrícia Oliveira',  'patricia.oliveira@email.com', '(11) 93333-4444'],
        ])->map(fn ($r) => Responsavel::create(['nome' => $r[0], 'email' => $r[1], 'telefone' => $r[2]]));

        // --- Alunos ----------------------------------------------
        $alunosData = [
            ['Pedro Silva',        '2026001', '3º Ano A', [0, 1]],
            ['Lucas Souza',        '2026002', '2º Ano B', [2]],
            ['Isabela Costa',      '2026003', '4º Ano A', [3]],
            ['Mariana Pereira',    '2026004', '1º Ano C', [4]],
            ['Gabriel Rocha',      '2026005', '5º Ano A', [5]],
            ['Sofia Andrade',      '2026006', '3º Ano B', [6]],
            ['Rafael Oliveira',    '2026007', '2º Ano A', [7]],
            ['Beatriz Silva',      '2026008', '4º Ano B', [0]],
            ['Davi Souza',         '2026009', '1º Ano A', [2]],
            ['Helena Costa',       '2026010', '5º Ano B', [3]],
        ];

        $parentescos = ['Mãe', 'Pai', 'Mãe', 'Mãe', 'Pai', 'Mãe', 'Pai', 'Mãe', 'Mãe', 'Mãe'];

        $alunos = collect();
        foreach ($alunosData as $i => [$nome, $mat, $turma, $respIdxs]) {
            $aluno = Aluno::create(['nome' => $nome, 'matricula' => $mat, 'turma' => $turma]);
            $pivot = [];
            foreach ($respIdxs as $idx) {
                $pivot[$resps[$idx]->id] = ['parentesco' => $parentescos[$idx]];
            }
            $aluno->responsaveis()->attach($pivot);
            $alunos->push($aluno);
        }

        // --- Autorizações ----------------------------------------
        Autorizacao::create([
            'aluno_id' => $alunos[0]->id, 'responsavel_id' => $resps[0]->id,
            'aprovado_por' => $professor->id, 'tipo' => 'saida', 'status' => 'ativa',
            'motivo' => 'Consulta médica pré-agendada',
            'validade_inicio' => now(), 'validade_fim' => now()->addDays(7),
        ]);
        Autorizacao::create([
            'aluno_id' => $alunos[2]->id, 'responsavel_id' => $resps[3]->id,
            'aprovado_por' => $professor2->id, 'tipo' => 'saida', 'status' => 'ativa',
            'motivo' => 'Atividade esportiva externa',
            'validade_inicio' => now(), 'validade_fim' => now()->addDays(3),
        ]);
        Autorizacao::create([
            'aluno_id' => $alunos[4]->id, 'responsavel_id' => $resps[5]->id,
            'aprovado_por' => $professor->id, 'tipo' => 'saida', 'status' => 'ativa',
            'motivo' => 'Apresentação cultural',
            'validade_inicio' => now(), 'validade_fim' => now()->addDay(),
        ]);
        Autorizacao::create([
            'aluno_id' => $alunos[1]->id, 'responsavel_id' => $resps[2]->id,
            'tipo' => 'saida', 'status' => 'pendente_professor',
            'motivo' => 'Atividade extracurricular',
        ]);
        Autorizacao::create([
            'aluno_id' => $alunos[3]->id, 'responsavel_id' => $resps[4]->id,
            'tipo' => 'saida', 'status' => 'pendente_professor',
            'motivo' => 'Consulta odontológica',
        ]);
        Autorizacao::create([
            'aluno_id' => $alunos[7]->id, 'responsavel_id' => $resps[0]->id,
            'aprovado_por' => $professor->id, 'tipo' => 'ambos', 'status' => 'revogada',
            'motivo' => 'Saída antecipada (cancelada)',
        ]);

        // --- Movimentações (histórico dos últimos 6 dias) --------
        foreach (range(0, 5) as $diasAtras) {
            $data = now()->subDays($diasAtras)->setTime(7, 30);
            foreach ($alunos->random(rand(4, 7)) as $a) {
                Movimentacao::create([
                    'aluno_id'       => $a->id,
                    'registrado_por' => $porteiro->id,
                    'tipo'           => 'entrada',
                    'created_at'     => $data->copy()->addMinutes(rand(0, 60)),
                    'updated_at'     => $data->copy()->addMinutes(rand(0, 60)),
                ]);
            }
            $saidaTime = now()->subDays($diasAtras)->setTime(17, 0);
            foreach ($alunos->random(rand(3, 6)) as $a) {
                Movimentacao::create([
                    'aluno_id'       => $a->id,
                    'registrado_por' => $porteiro->id,
                    'tipo'           => 'saida',
                    'created_at'     => $saidaTime->copy()->addMinutes(rand(0, 90)),
                    'updated_at'     => $saidaTime->copy()->addMinutes(rand(0, 90)),
                ]);
            }
        }

        */
    }
}
