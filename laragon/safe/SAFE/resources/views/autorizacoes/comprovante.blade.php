<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comprovante de Saída · {{ $autorizacao->aluno->nome }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Arial', sans-serif; }

        @media print {
            .no-print { display: none !important; }
            body { background: white !important; }
            .comprovante { box-shadow: none !important; border: 1px solid #ccc !important; }
        }
    </style>
</head>
<body class="bg-slate-100 min-h-screen flex flex-col items-center justify-start p-6">

    {{-- Barra de ação (não imprime) --}}
    <div class="no-print w-full max-w-2xl flex items-center justify-between mb-6">
        <a href="{{ route('autorizacoes.index') }}"
           class="flex items-center gap-2 text-sm text-slate-600 hover:text-slate-900 font-semibold">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Voltar
        </a>
        <button onclick="window.print()"
                class="flex items-center gap-2 bg-slate-800 hover:bg-slate-900 text-white font-semibold px-5 py-2.5 rounded-xl transition-colors text-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
            </svg>
            Imprimir
        </button>
    </div>

    {{-- Comprovante --}}
    <div class="comprovante w-full max-w-2xl bg-white rounded-2xl shadow-lg overflow-hidden">

        {{-- Cabeçalho --}}
        <div class="bg-slate-800 text-white px-8 py-6 flex items-center gap-5">
            <div class="w-14 h-14 rounded-xl bg-red-600 flex items-center justify-center shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="currentColor" viewBox="0 0 256 256">
                    <path d="M208,40H48A16,16,0,0,0,32,56V200a16,16,0,0,0,16,16H208a16,16,0,0,0,16-16V56A16,16,0,0,0,208,40Zm0,160H48V56H208V200ZM80,128a8,8,0,0,1,8-8h80a8,8,0,0,1,0,16H88A8,8,0,0,1,80,128Zm0,32a8,8,0,0,1,8-8h80a8,8,0,0,1,0,16H88A8,8,0,0,1,80,160ZM88,88h80a8,8,0,0,1,0,16H88a8,8,0,0,1,0-16Z"/>
                </svg>
            </div>
            <div>
                <p class="text-xs text-slate-400 uppercase tracking-widest font-semibold">SENAI · SAFE</p>
                <h1 class="text-xl font-bold leading-tight">Autorização de Saída Antecipada</h1>
                <p class="text-xs text-slate-400 mt-0.5">Nº {{ str_pad($autorizacao->id, 6, '0', STR_PAD_LEFT) }}
                    · Emitida em {{ $autorizacao->created_at->format('d/m/Y \à\s H:i') }}</p>
            </div>
        </div>

        {{-- Dados do aluno --}}
        <div class="px-8 py-6 border-b border-slate-100">
            <p class="text-[10px] text-slate-400 uppercase tracking-widest font-bold mb-3">Dados do Aluno</p>
            <div class="grid grid-cols-3 gap-4">
                <div class="col-span-2">
                    <p class="text-xs text-slate-500">Nome completo</p>
                    <p class="font-bold text-slate-900 text-lg leading-tight">{{ $autorizacao->aluno->nome }}</p>
                </div>
                <div>
                    <p class="text-xs text-slate-500">Matrícula</p>
                    <p class="font-bold text-slate-900">{{ $autorizacao->aluno->matricula }}</p>
                </div>
                <div>
                    <p class="text-xs text-slate-500">Turma</p>
                    <p class="font-bold text-slate-900">{{ $autorizacao->aluno->turma }}</p>
                </div>
            </div>
        </div>

        {{-- Dados da saída --}}
        <div class="px-8 py-6 border-b border-slate-100">
            <p class="text-[10px] text-slate-400 uppercase tracking-widest font-bold mb-3">Dados da Saída</p>
            <div class="grid grid-cols-3 gap-4">
                <div>
                    <p class="text-xs text-slate-500">Horário de saída</p>
                    <p class="font-bold text-slate-900 text-lg">
                        {{ $autorizacao->validade_inicio?->format('H:i') ?? '—' }}
                    </p>
                    <p class="text-xs text-slate-400">{{ $autorizacao->validade_inicio?->format('d/m/Y') ?? '' }}</p>
                </div>
                <div>
                    <p class="text-xs text-slate-500">Faltas a receber</p>
                    <p class="font-bold text-slate-900 text-lg">{{ $autorizacao->faltas }}</p>
                    <p class="text-xs text-slate-400">{{ $autorizacao->faltas == 1 ? 'falta' : 'faltas' }}</p>
                </div>
                <div>
                    <p class="text-xs text-slate-500">Motivo</p>
                    <p class="font-semibold text-slate-800 text-sm">{{ $autorizacao->motivo }}</p>
                </div>
            </div>
        </div>

        {{-- Responsável (se houver) --}}
        @if($autorizacao->responsavel)
        <div class="px-8 py-5 border-b border-slate-100 bg-amber-50">
            <p class="text-[10px] text-amber-700 uppercase tracking-widest font-bold mb-2">Responsável Autorizante</p>
            <div class="flex items-center gap-4">
                <div>
                    <p class="font-bold text-slate-900">{{ $autorizacao->responsavel->nome }}</p>
                    <p class="text-xs text-slate-500">{{ $autorizacao->responsavel->telefone }}</p>
                </div>
            </div>
        </div>
        @endif

        {{-- Rodapé --}}
        <div class="px-8 py-5 bg-slate-50 flex items-center justify-between">
            <div>
                <p class="text-xs text-slate-500">Emitido por</p>
                <p class="font-semibold text-slate-800 text-sm">{{ $autorizacao->aprovadoPor?->name ?? '—' }}</p>
            </div>
            <div class="text-right">
                <div class="inline-block border-t-2 border-slate-400 pt-2 px-8 text-xs text-slate-500">
                    Assinatura do Professor
                </div>
            </div>
        </div>

    </div>

    <p class="no-print text-xs text-slate-400 mt-4">Este documento substitui o papel físico de autorização de saída.</p>
</body>
</html>
