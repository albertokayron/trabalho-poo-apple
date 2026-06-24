<!DOCTYPE html>
<html lang="pt-BR" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Apple Service Management</title>
    
    <!-- Google Fonts: Inter e Plus Jakarta Sans para tipografia estilo Apple -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Script inline para carregar o tema escuro o mais rápido possível e evitar oscilação de luz -->
    <script>
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>
    
    <!-- Tailwind CSS via CDN com configuração customizada de tema -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'Inter', '-apple-system', 'sans-serif'],
                    },
                    colors: {
                        apple: {
                            black: '#1d1d1f',
                            gray: '#86868b',
                            lightgray: '#f5f5f7',
                            blue: '#0071e3',
                            darkbg: '#000000',
                            darkcard: '#1c1c1e',
                            darkborder: '#2c2c2e'
                        }
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.5s ease-out forwards',
                        'slide-up': 'slideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards',
                        'pulse-slow': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' },
                        },
                        slideUp: {
                            '0%': { transform: 'translateY(16px)', opacity: '0' },
                            '100%': { transform: 'translateY(0)', opacity: '1' },
                        }
                    }
                }
            }
        }
    </script>
    
    <!-- Estilos globais adicionais -->
    <style>
        body {
            font-family: 'Plus Jakarta Sans', 'Inter', sans-serif;
        }
        .apple-blur {
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
        }
    </style>
</head>
<body class="flex flex-col min-h-screen h-full bg-[#f5f5f7] dark:bg-black text-apple-black dark:text-gray-100 transition-colors duration-300">

    <!-- Barra de Navegação Estilo Apple Floating Glass -->
    <nav class="sticky top-0 z-50 bg-white/70 dark:bg-black/70 apple-blur border-b border-gray-200/50 dark:border-zinc-800/80 text-apple-black dark:text-white transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-14">
                <div class="flex items-center space-x-8">
                    <!-- Logo Apple (Ícone SVG) -->
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-2 text-apple-black dark:text-white hover:text-apple-blue dark:hover:text-apple-blue transition-colors">
                        <svg class="h-5 w-5 fill-current" viewBox="0 0 170 170">
                            <path d="M150.37 130.25c-2.45 5.66-5.35 10.87-8.71 15.66-4.58 6.53-8.33 11.05-11.22 13.56-4.48 4.12-9.28 6.23-14.42 6.35-3.69 0-8.14-1.05-13.32-3.18-5.19-2.12-9.97-3.17-14.34-3.17-4.58 0-9.49 1.05-14.75 3.17-5.26 2.13-9.5 3.24-12.74 3.35-4.34.13-9.13-1.93-14.37-6.21-3.43-2.68-7.31-7.3-11.61-13.85-8.83-13.56-15.58-29.62-20.25-48.2-4.67-18.57-7-35.34-7-50.29 0-16.74 4.02-30.56 12.06-41.48 8.05-10.92 18.27-16.48 30.68-16.69 5.82 0 12.13 1.53 18.96 4.6 6.83 3.07 11.2 4.6 13.12 4.6 1.8 0 6.09-1.5 12.87-4.5 6.78-2.99 12.79-4.43 18.04-4.32 14.62.21 26.01 5.46 34.17 15.71 8.16 10.25 11.96 22.86 11.39 37.82-1.02 11.41-4.76 21.39-11.2 29.96-6.44 8.57-13.06 14.62-19.86 18.16-5.26 2.89-7.89 6.44-7.89 10.66 0 3.2 2.37 6.49 7.12 9.89 7.02 4.54 13.56 10.15 19.64 16.85 6.08 6.7 10.51 14.12 13.3 22.27zM119.22 19.01c0-7.84 2.68-15.11 8.04-21.81 5.36-6.69 12.06-11.29 20.1-13.8 1.03 8.35-1.55 16.03-7.73 23.04-6.19 7.01-13.25 11.75-21.2 12.21-.83-1.39-1.21-3.22-1.21-5.64z"/>
                        </svg>
                        <span class="font-bold text-sm tracking-tight">Apple Interno</span>
                    </a>
                    
                    <!-- Links de Navegação Desktop -->
                    <div class="hidden md:flex space-x-6 text-xs uppercase tracking-wider font-semibold">
                        <a href="{{ route('dashboard') }}" class="hover:text-apple-blue dark:hover:text-apple-blue transition-colors duration-200 pb-1.5 {{ Request::is('/') ? 'text-apple-blue border-b-2 border-apple-blue' : 'text-gray-500 dark:text-gray-400' }}">Dashboard</a>
                        <a href="{{ route('usuarios.index') }}" class="hover:text-apple-blue dark:hover:text-apple-blue transition-colors duration-200 pb-1.5 {{ Request::is('usuarios*') ? 'text-apple-blue border-b-2 border-apple-blue' : 'text-gray-500 dark:text-gray-400' }}">Funcionários</a>
                        <a href="{{ route('aparelhos.index') }}" class="hover:text-apple-blue dark:hover:text-apple-blue transition-colors duration-200 pb-1.5 {{ Request::is('aparelhos*') ? 'text-apple-blue border-b-2 border-apple-blue' : 'text-gray-500 dark:text-gray-400' }}">Aparelhos</a>
                        <a href="{{ route('manutencoes.index') }}" class="hover:text-apple-blue dark:hover:text-apple-blue transition-colors duration-200 pb-1.5 {{ Request::is('manutencoes*') ? 'text-apple-blue border-b-2 border-apple-blue' : 'text-gray-500 dark:text-gray-400' }}">Manutenções</a>
                    </div>
                </div>

                <!-- Lado Direito: Seletor de Tema -->
                <div class="flex items-center space-x-4">
                    <button id="theme-toggle" class="p-2 rounded-full bg-gray-100 dark:bg-zinc-800/80 hover:bg-gray-200 dark:hover:bg-zinc-700/80 text-gray-500 dark:text-gray-400 hover:text-apple-black dark:hover:text-white transition-all duration-200" aria-label="Alternar tema">
                        <!-- Icone Sol (Exibido no Dark Mode) -->
                        <svg id="theme-toggle-light-icon" class="hidden w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 15a5 5 0 100-10 5 5 0 000 10zm0-11a1 1 0 00-1-1V2a1 1 0 102 0v1a1 1 0 00-1 1zm0 12a1 1 0 00-1 1v1a1 1 0 102 0v-1a1 1 0 00-1-1zM4.34 5.754a1 1 0 00-1.414 1.414l.707.707a1 1 0 001.414-1.414l-.707-.707zm10.606 10.606a1 1 0 00-1.414 1.414l.707.707a1 1 0 001.414-1.414l-.707-.707zM3 10a1 1 0 000-2H2a1 1 0 100 2h1zm14 0a1 1 0 000-2h-1a1 1 0 100 2h1zM4.34 14.246l-.707.707a1 1 0 101.414 1.414l.707-.707a1 1 0 00-1.414-1.414zm10.606-10.606l-.707.707a1 1 0 101.414 1.414l.707-.707a1 1 0 00-1.414-1.414z"/>
                        </svg>
                        <!-- Icone Lua (Exibido no Light Mode) -->
                        <svg id="theme-toggle-dark-icon" class="hidden w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Conteúdo Principal -->
    <main class="flex-grow max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-8 animate-fade-in">
        
        <!-- Alertas de Sucesso ou Erro Dinâmicos e Minimalistas -->
        @if (session('success'))
            <div id="alert-success" class="mb-6 p-4 rounded-2xl bg-white dark:bg-zinc-900 border border-emerald-100 dark:border-emerald-900/30 shadow-sm flex items-start justify-between space-x-3 transition-all duration-300 animate-slide-up">
                <div class="flex items-start space-x-3">
                    <div class="p-1 rounded-full bg-emerald-50 dark:bg-emerald-950/50 text-emerald-600 dark:text-emerald-400">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold text-apple-black dark:text-white">Sucesso</h3>
                        <p class="text-xs text-apple-gray dark:text-gray-400 mt-0.5">{{ session('success') }}</p>
                    </div>
                </div>
                <button onclick="document.getElementById('alert-success').remove()" class="text-apple-gray dark:text-gray-500 hover:text-apple-black dark:hover:text-white transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
        @endif

        @if ($errors->any())
            <div id="alert-error" class="mb-6 p-4 rounded-2xl bg-white dark:bg-zinc-900 border border-rose-100 dark:border-rose-900/30 shadow-sm flex items-start justify-between space-x-3 transition-all duration-300 animate-slide-up">
                <div class="flex items-start space-x-3">
                    <div class="p-1 rounded-full bg-rose-50 dark:bg-rose-950/50 text-rose-600 dark:text-rose-400">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold text-apple-black dark:text-white">Atenção! Ocorreram alguns erros:</h3>
                        <ul class="list-disc list-inside text-xs text-rose-500 dark:text-rose-400 mt-1 space-y-0.5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <button onclick="document.getElementById('alert-error').remove()" class="text-apple-gray dark:text-gray-500 hover:text-apple-black dark:hover:text-white transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
        @endif

        <!-- Seção Dinâmica Renderizada pelas Views Filhas -->
        <div class="animate-slide-up">
            @yield('content')
        </div>
    </main>

    <!-- Rodapé Minimalista -->
    <footer class="bg-white dark:bg-zinc-950 border-t border-gray-200 dark:border-zinc-800/80 text-apple-gray dark:text-gray-500 py-6 mt-12 transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center md:flex md:justify-between md:items-center">
            <p class="text-xs">&copy; {{ date('Y') }} Apple Inc. Sistema de Gerenciamento Interno. Todos os direitos reservados.</p>
            <div class="mt-2 md:mt-0 flex justify-center space-x-4 text-xs font-medium">
                <span class="hover:text-apple-black dark:hover:text-white transition-colors">Ambiente Didático</span>
                <span>&bull;</span>
                <span class="hover:text-apple-black dark:hover:text-white transition-colors">Laravel MVC</span>
            </div>
        </div>
    </footer>

    <!-- Lógica JavaScript do Toggle de Tema -->
    <script>
        var themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
        var themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

        if (document.documentElement.classList.contains('dark')) {
            themeToggleLightIcon.classList.remove('hidden');
        } else {
            themeToggleDarkIcon.classList.remove('hidden');
        }

        var themeToggleBtn = document.getElementById('theme-toggle');

        themeToggleBtn.addEventListener('click', function() {
            themeToggleDarkIcon.classList.toggle('hidden');
            themeToggleLightIcon.classList.toggle('hidden');

            if (localStorage.getItem('color-theme')) {
                if (localStorage.getItem('color-theme') === 'light') {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                } else {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                }
            } else {
                if (document.documentElement.classList.contains('dark')) {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                } else {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                }
            }
        });
    </script>
</body>
</html>

