<!DOCTYPE html>
<html lang="pt-BR" class="h-full bg-[#f5f5f7]">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Apple Service Management</title>
    
    <!-- Google Fonts: Inter para tipografia limpa estilo Apple -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS via CDN para estilização rápida e responsiva -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        apple: {
                            black: '#1d1d1f',
                            gray: '#86868b',
                            lightgray: '#f5f5f7',
                            blue: '#0071e3',
                        }
                    }
                }
            }
        }
    </script>
    
    <!-- Efeitos de transição e sombras customizadas -->
    <style>
        body {
            font-family: 'Inter', sans-serif;
            color: #1d1d1f;
        }
        .apple-blur {
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
        }
        .transition-all-300 {
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }
    </style>
</head>
<body class="flex flex-col min-h-screen h-full text-apple-black">

    <!-- Barra de Navegação estilo Apple Bar -->
    <nav class="sticky top-0 z-50 bg-[#1d1d1f]/90 apple-blur border-b border-white/10 text-white transition-all-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-12">
                <div class="flex items-center space-x-8">
                    <!-- Logo Apple (Ícone SVG) -->
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-2 text-white hover:text-gray-300 transition-colors">
                        <svg class="h-5 w-5 fill-current" viewBox="0 0 170 170">
                            <path d="M150.37 130.25c-2.45 5.66-5.35 10.87-8.71 15.66-4.58 6.53-8.33 11.05-11.22 13.56-4.48 4.12-9.28 6.23-14.42 6.35-3.69 0-8.14-1.05-13.32-3.18-5.19-2.12-9.97-3.17-14.34-3.17-4.58 0-9.49 1.05-14.75 3.17-5.26 2.13-9.5 3.24-12.74 3.35-4.34.13-9.13-1.93-14.37-6.21-3.43-2.68-7.31-7.3-11.61-13.85-8.83-13.56-15.58-29.62-20.25-48.2-4.67-18.57-7-35.34-7-50.29 0-16.74 4.02-30.56 12.06-41.48 8.05-10.92 18.27-16.48 30.68-16.69 5.82 0 12.13 1.53 18.96 4.6 6.83 3.07 11.2 4.6 13.12 4.6 1.8 0 6.09-1.5 12.87-4.5 6.78-2.99 12.79-4.43 18.04-4.32 14.62.21 26.01 5.46 34.17 15.71 8.16 10.25 11.96 22.86 11.39 37.82-1.02 11.41-4.76 21.39-11.2 29.96-6.44 8.57-13.06 14.62-19.86 18.16-5.26 2.89-7.89 6.44-7.89 10.66 0 3.2 2.37 6.49 7.12 9.89 7.02 4.54 13.56 10.15 19.64 16.85 6.08 6.7 10.51 14.12 13.3 22.27zM119.22 19.01c0-7.84 2.68-15.11 8.04-21.81 5.36-6.69 12.06-11.29 20.1-13.8 1.03 8.35-1.55 16.03-7.73 23.04-6.19 7.01-13.25 11.75-21.2 12.21-.83-1.39-1.21-3.22-1.21-5.64z"/>
                        </svg>
                        <span class="font-semibold text-sm tracking-tight">Apple Interno</span>
                    </a>
                    
                    <!-- Links de Navegação Desktop -->
                    <div class="hidden md:flex space-x-6 text-xs uppercase tracking-wider font-medium text-gray-400">
                        <a href="{{ route('dashboard') }}" class="hover:text-white transition-colors duration-200 {{ Request::is('/') ? 'text-white border-b-2 border-white pb-1' : '' }}">Dashboard</a>
                        <a href="{{ route('usuarios.index') }}" class="hover:text-white transition-colors duration-200 {{ Request::is('usuarios*') ? 'text-white border-b-2 border-white pb-1' : '' }}">Funcionários</a>
                        <a href="{{ route('aparelhos.index') }}" class="hover:text-white transition-colors duration-200 {{ Request::is('aparelhos*') ? 'text-white border-b-2 border-white pb-1' : '' }}">Aparelhos</a>
                        <a href="{{ route('manutencoes.index') }}" class="hover:text-white transition-colors duration-200 {{ Request::is('manutencoes*') ? 'text-white border-b-2 border-white pb-1' : '' }}">Manutenções</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Conteúdo Principal -->
    <main class="flex-grow max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <!-- Alertas de Sucesso ou Erro Dinâmicos -->
        @if (session('success'))
            <div class="mb-6 p-4 rounded-xl bg-white border border-emerald-100 shadow-sm flex items-start space-x-3 transition-all-300 animate-fade-in">
                <div class="p-1 rounded-full bg-emerald-50 text-emerald-600">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-sm font-medium text-apple-black">Sucesso</h3>
                    <p class="text-xs text-apple-gray mt-0.5">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-6 p-4 rounded-xl bg-white border border-rose-100 shadow-sm flex items-start space-x-3 transition-all-300">
                <div class="p-1 rounded-full bg-rose-50 text-rose-600">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-sm font-medium text-apple-black">Atenção! Ocorreram alguns erros:</h3>
                    <ul class="list-disc list-inside text-xs text-rose-500 mt-1 space-y-0.5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <!-- Seção Dinâmica Renderizada pelas Views Filhas -->
        <div class="animate-fade-in">
            @yield('content')
        </div>
    </main>

    <!-- Rodapé Minimalista -->
    <footer class="bg-white border-t border-gray-200 text-apple-gray py-6 mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center md:flex md:justify-between md:items-center">
            <p class="text-xs">&copy; {{ date('Y') }} Apple Inc. Sistema de Gerenciamento Interno. Todos os direitos reservados.</p>
            <div class="mt-2 md:mt-0 flex justify-center space-x-4 text-xs font-medium">
                <span class="hover:text-apple-black transition-colors">Ambiente Escolar / Didático</span>
                <span>&bull;</span>
                <span class="hover:text-apple-black transition-colors">Laravel MVC</span>
            </div>
        </div>
    </footer>

</body>
</html>
