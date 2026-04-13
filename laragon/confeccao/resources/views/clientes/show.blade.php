<x-app-layout>
    <x-slot name="header"></x-slot>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;1,9..40,300&display=swap');
        :root{--ink:#0a0a0f;--surface:#f5f4f0;--card:#fff;--muted:#888;--border:#e8e6e1;--accent:#0ea87e;--red:#ff4c4c;}
        *{box-sizing:border-box;margin:0;padding:0;}
        .root{font-family:'DM Sans',sans-serif;background:var(--surface);min-height:100vh;color:var(--ink);}
        .hero{position:relative;overflow:hidden;background:var(--ink);padding:2.5rem 2.5rem 2rem;}
        .hero::before{content:'';position:absolute;inset:0;background:radial-gradient(ellipse 60% 80% at 85% -10%,rgba(14,168,126,.45) 0%,transparent 65%),radial-gradient(ellipse 35% 55% at -5% 110%,rgba(14,168,126,.25) 0%,transparent 60%);pointer-events:none;}
        .hero-inner{position:relative;z-index:1;max-width:720px;margin:0 auto;display:flex;align-items:center;justify-content:space-between;gap:1rem;flex-wrap:wrap;}
        .hero-left{display:flex;align-items:center;gap:1rem;}
        .back{display:inline-flex;align-items:center;gap:.4rem;color:rgba(255,255,255,.5);font-size:.82rem;font-weight:500;text-decoration:none;transition:color .2s;flex-shrink:0;}
        .back:hover{color:#fff;}
        .divider{width:1px;height:28px;background:rgba(255,255,255,.15);flex-shrink:0;}
        .hero-title{font-family:'Syne',sans-serif;font-size:clamp(1.3rem,3vw,1.9rem);font-weight:800;color:#fff;letter-spacing:-.03em;}
        .btn-hero{display:inline-flex;align-items:center;gap:.4rem;background:rgba(255,255,255,.1);border:1px solid rgba(255,255,255,.2);color:#fff;font-family:'Syne',sans-serif;font-weight:700;font-size:.78rem;letter-spacing:.04em;text-transform:uppercase;padding:.6rem 1.2rem;border-radius:100px;text-decoration:none;transition:all .2s;}
        .btn-hero:hover{background:rgba(255,255,255,.2);}
        .body{max-width:720px;margin:0 auto;padding:2.5rem 2rem 4rem;}
        .card{background:var(--card);border:1px solid var(--border);border-radius:24px;overflow:hidden;box-shadow:0 4px 24px rgba(0,0,0,.04);animation:up .45s ease both;}
        @keyframes up{from{opacity:0;transform:translateY(16px)}to{opacity:1;transform:translateY(0)}}
        .card-head{padding:2rem;border-bottom:1px solid var(--border);display:flex;align-items:center;gap:1.25rem;}
        .avatar{width:64px;height:64px;border-radius:18px;background:linear-gradient(135deg,#0ea87e,#3b82f6);display:flex;align-items:center;justify-content:center;font-family:'Syne',sans-serif;font-weight:800;font-size:1.4rem;color:#fff;flex-shrink:0;}
        .cname{font-family:'Syne',sans-serif;font-size:1.5rem;font-weight:800;letter-spacing:-.02em;}
        .cid{font-size:.8rem;color:var(--muted);margin-top:.2rem;font-family:'Syne',sans-serif;font-weight:600;letter-spacing:.06em;}
        .card-body{padding:2rem;}
        .grid{display:grid;grid-template-columns:1fr 1fr;gap:1.5rem;}
        .fi{display:flex;flex-direction:column;gap:.3rem;}
        .fi-label{font-size:.72rem;font-weight:700;text-transform:uppercase;letter-spacing:.1em;color:var(--muted);}
        .fi-value{font-size:.95rem;font-weight:500;}
        .fi-value.empty{color:#bbb;font-style:italic;}
        .card-foot{padding:1.5rem 2rem;border-top:1px solid var(--border);display:flex;justify-content:space-between;align-items:center;gap:1rem;flex-wrap:wrap;}
        .btn-back{display:inline-flex;align-items:center;gap:.4rem;background:transparent;border:1.5px solid var(--border);color:var(--muted);font-family:'Syne',sans-serif;font-weight:700;font-size:.82rem;letter-spacing:.04em;text-transform:uppercase;padding:.75rem 1.5rem;border-radius:100px;text-decoration:none;transition:all .2s;}
        .btn-back:hover{border-color:var(--ink);color:var(--ink);}
        .btn-edit{display:inline-flex;align-items:center;gap:.5rem;background:var(--accent);color:#fff;font-family:'Syne',sans-serif;font-weight:700;font-size:.82rem;letter-spacing:.04em;text-transform:uppercase;padding:.75rem 1.75rem;border-radius:100px;text-decoration:none;transition:transform .2s,box-shadow .2s,filter .2s;}
        .btn-edit:hover{filter:brightness(1.1);transform:translateY(-2px);box-shadow:0 10px 28px rgba(14,168,126,.35);}
        @media(max-width:600px){.body{padding:1.5rem 1rem 3rem}.grid{grid-template-columns:1fr}.hero{padding:1.75rem 1.25rem 1.5rem}.card-body{padding:1.25rem}.card-foot{padding:1.25rem;flex-direction:column}.btn-back,.btn-edit{width:100%;justify-content:center}}
    </style>
    <div class="root">
        <div class="hero">
            <div class="hero-inner">
                <div class="hero-left">
                    <a href="{{ route('clientes.index') }}" class="back">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
                        Clientes
                    </a>
                    <div class="divider"></div>
                    <span class="hero-title">Detalhes do Cliente</span>
                </div>
                <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn-hero">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                    Editar
                </a>
            </div>
        </div>
        <div class="body">
            <div class="card">
                <div class="card-head">
                    <div class="avatar">{{ strtoupper(substr($cliente->nome,0,1)) }}{{ strtoupper(substr(strstr($cliente->nome,' ')?:'  ',1,1)) }}</div>
                    <div>
                        <div class="cname">{{ $cliente->nome }}</div>
                        <div class="cid">#{{ $cliente->id }} · Cliente</div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="grid">
                        <div class="fi"><span class="fi-label">CPF</span><span class="fi-value {{ !$cliente->cpf?'empty':'' }}">{{ $cliente->cpf ?? 'Não informado' }}</span></div>
                        <div class="fi"><span class="fi-label">Telefone</span><span class="fi-value {{ !$cliente->telefone?'empty':'' }}">{{ $cliente->telefone ?? 'Não informado' }}</span></div>
                        <div class="fi"><span class="fi-label">Cadastrado em</span><span class="fi-value">{{ \Carbon\Carbon::parse($cliente->created_at)->format('d/m/Y \à\s H:i') }}</span></div>
                        <div class="fi"><span class="fi-label">Atualizado em</span><span class="fi-value">{{ $cliente->updated_at ? \Carbon\Carbon::parse($cliente->updated_at)->format('d/m/Y \à\s H:i') : '—' }}</span></div>
                    </div>
                </div>
                <div class="card-foot">
                    <a href="{{ route('clientes.index') }}" class="btn-back">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
                        Voltar
                    </a>
                    <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn-edit">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                        Editar cliente
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>