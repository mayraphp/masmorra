<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masmorra de Turno</title>
 
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pixelify+Sans:wght@500;700&family=Silkscreen:wght@400;700&display=swap" rel="stylesheet">
 
    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }
 
        :root {
            --gold: #f2c94c;
            --gold-dark: #8a5a12;
            --crimson: #6e0f14;
            --crimson-light: #b3242a;
            --ink: #0a0d14;
            --font-title: 'Pixelify Sans', monospace;
            --font-ui: 'Silkscreen', monospace;
        }
 
        html, body { height: 100%; }
 
        body {
            font-family: var(--font-ui);
            color: #f3ead7;
            background: var(--ink);
            overflow: hidden;
            -webkit-font-smoothing: none; /* bordas da fonte mais "duras" */
        }
 
        /* ── Fundo ── */
        .scene {
            position: fixed;
            inset: 0;
            background: url('{{ asset('images/masmorra.png') }}') center / cover no-repeat;
            animation: slow-zoom 30s ease-in-out infinite alternate;
        }
 
        /* Escurece as bordas e a base para o texto ficar legível */
        .vignette {
            position: fixed;
            inset: 0;
            background:
                radial-gradient(ellipse at center, transparent 40%, rgba(0, 0, 0, .75) 100%),
                linear-gradient(to bottom, rgba(0, 0, 0, .6) 0%, transparent 28%, transparent 60%, rgba(0, 0, 0, .85) 100%);
            pointer-events: none;
        }
 
        /* Névoa passando na parte de baixo */
        .fog {
            position: fixed;
            left: -50%;
            bottom: -10%;
            width: 200%;
            height: 40%;
            background: radial-gradient(ellipse at center, rgba(200, 215, 240, .18) 0%, transparent 60%);
            filter: blur(20px);
            animation: fog-drift 25s ease-in-out infinite alternate;
            pointer-events: none;
        }
        .fog.second {
            bottom: -15%;
            opacity: .7;
            animation-duration: 38s;
            animation-direction: alternate-reverse;
        }
 
        /* Brasas quadradas, estilo pixel */
        .embers span {
            position: fixed;
            bottom: -10px;
            width: 4px;
            height: 4px;
            background: #ffb347;
            box-shadow: 0 0 0 1px #ff6a1a;
            opacity: 0;
            animation: ember-rise steps(40) infinite;
            pointer-events: none;
        }
 
        /* ── Conteúdo ── */
        .content {
            position: relative;
            z-index: 2;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-between;
            padding: 6vh 16px 8vh;
            text-align: center;
        }
 
        .title {
            font-family: var(--font-title);
            font-weight: 700;
            font-size: clamp(2.6rem, 8vw, 6rem);
            line-height: .95;
            letter-spacing: .02em;
            text-transform: uppercase;
            color: var(--gold);
            /* Sombra em degraus: contorno escuro + profundidade vermelha */
            text-shadow:
                3px 0 0 #2a1406, -3px 0 0 #2a1406,
                0 3px 0 #2a1406, 0 -3px 0 #2a1406,
                3px 3px 0 #2a1406,
                6px 6px 0 var(--crimson),
                9px 9px 0 #1a0406;
            animation: fade-down 1.4s steps(8) both;
        }
 
        .subtitle {
            margin-top: 1.2rem;
            font-family: var(--font-ui);
            font-size: clamp(.75rem, 1.5vw, 1rem);
            letter-spacing: .35em;
            text-transform: uppercase;
            color: #f3ead7;
            text-shadow: 2px 2px 0 #000;
            animation: blink-in 2s .8s steps(1) both;
        }
 
        .menu {
            display: flex;
            flex-direction: column;
            gap: 16px;
            width: min(320px, 100%);
            animation: fade-up 1.2s 1.2s steps(6) both;
        }
 
        .btn {
            font-family: var(--font-ui);
            font-weight: 700;
            font-size: 1rem;
            letter-spacing: .08em;
            text-transform: uppercase;
            color: #f3ead7;
            padding: 14px 20px;
            border: none;
            border-radius: 0;
            background: #1a120d;
            /* Borda pixelada feita com sombras: dourada por dentro, preta por fora */
            box-shadow:
                0 0 0 3px var(--gold-dark),
                0 0 0 6px #000,
                6px 6px 0 6px rgba(0, 0, 0, .6);
            text-shadow: 2px 2px 0 #000;
            cursor: pointer;
            transition: transform .08s steps(2);
        }
        .btn:hover:not(:disabled),
        .btn:focus-visible {
            color: var(--gold);
            transform: translate(-2px, -2px);
            box-shadow:
                0 0 0 3px var(--gold),
                0 0 0 6px #000,
                8px 8px 0 6px rgba(0, 0, 0, .6);
            outline: none;
        }
        .btn:active:not(:disabled) {
            transform: translate(2px, 2px);
            box-shadow:
                0 0 0 3px var(--gold),
                0 0 0 6px #000,
                2px 2px 0 6px rgba(0, 0, 0, .6);
        }
        .btn.primary {
            background: var(--crimson-light);
            box-shadow:
                inset 0 -4px 0 var(--crimson),
                0 0 0 3px var(--gold),
                0 0 0 6px #000,
                6px 6px 0 6px rgba(0, 0, 0, .6);
        }
        .btn.primary:hover {
            color: #fff3c4;
            box-shadow:
                inset 0 -4px 0 var(--crimson),
                0 0 0 3px #fff3c4,
                0 0 0 6px #000,
                8px 8px 0 6px rgba(0, 0, 0, .6);
        }
        .btn:disabled {
            opacity: .45;
            cursor: not-allowed;
        }
 
        .footer {
            margin-top: 20px;
            font-size: .7rem;
            letter-spacing: .15em;
            color: rgba(243, 234, 215, .75);
            text-shadow: 2px 2px 0 #000;
            animation: blink 1.2s steps(1) infinite 3s;
        }
 
        /* ── Animações (steps() deixa o movimento "quadro a quadro") ── */
        @keyframes slow-zoom  { from { transform: scale(1); } to { transform: scale(1.06); } }
        @keyframes fog-drift  { from { transform: translateX(-8%); } to { transform: translateX(8%); } }
        @keyframes fade-down  { from { opacity: 0; transform: translateY(-30px); } to { opacity: 1; transform: none; } }
        @keyframes fade-up    { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: none; } }
        @keyframes blink-in   { 0% { opacity: 0; } 30% { opacity: 1; } 40% { opacity: 0; } 50%, 100% { opacity: 1; } }
        @keyframes blink      { 0%, 100% { opacity: 1; } 50% { opacity: 0; } }
        @keyframes ember-rise {
            0%   { opacity: 0; transform: translate(0, 0); }
            10%  { opacity: 1; }
            100% { opacity: 0; transform: translate(var(--drift), -70vh); }
        }
 
        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after { animation: none !important; }
        }
    </style>
</head>
<body>
    <div class="scene"></div>
    <div class="fog"></div>
    <div class="fog second"></div>
    <div class="vignette"></div>
 
    <div class="embers">
        @foreach (range(1, 14) as $i)
            <span style="
                left: {{ rand(5, 95) }}%;
                --drift: {{ rand(-80, 80) }}px;
                animation-duration: {{ rand(6, 12) }}s;
                animation-delay: {{ rand(0, 10) }}s;
            "></span>
        @endforeach
    </div>
 
    <main class="content">
        <header>
            <h1 class="title">Masmorra de Turno</h1>
            <p class="subtitle">Ouse descer</p>
        </header>
 
        <nav class="menu">
            <button class="btn primary" type="button">Nova Aventura</button>
            <button class="btn" type="button" disabled>Continuar</button>
            <p class="footer">▶ Pressione start</p>
        </nav>
    </main>
</body>
</html>