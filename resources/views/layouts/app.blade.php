<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- Bootstrap Icons -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Stack untuk styles tambahan dari child view -->
        @stack('styles')
        <style>
            /* Responsive Touch-friendly Adjustments (min 44x44px for touch targets) */
            @media (max-width: 767.98px) {
                .btn, .form-control, .form-select, .page-link {
                    min-height: 44px;
                }
                .btn {
                    display: inline-flex;
                    align-items: center;
                    justify-content: center;
                }
                /* Mengatasi masalah responsive tables di mobile */
                .table-responsive {
                    border: 0;
                }
                .btn-sm {
                    min-height: 44px;
                    font-size: 0.875rem !important;
                    padding-top: 0.5rem;
                    padding-bottom: 0.5rem;
                }
                /* Fix icon centering */
                .btn i.bi {
                    display: flex;
                    align-items: center;
                }
            }

            /* Dark Mode Overrides */
            html[data-bs-theme="dark"] body { background-color: #212529 !important; color: #f8f9fa !important; }
            html[data-bs-theme="dark"] .bg-white { background-color: #2b3035 !important; }
            html[data-bs-theme="dark"] .bg-gray-50 { background-color: #212529 !important; }
            html[data-bs-theme="dark"] .bg-gray-100 { background-color: #212529 !important; }
            html[data-bs-theme="dark"] .text-gray-800 { color: #f8f9fa !important; }
            html[data-bs-theme="dark"] .text-gray-500 { color: #adb5bd !important; }
            html[data-bs-theme="dark"] .border-gray-100, 
            html[data-bs-theme="dark"] .border-gray-200, 
            html[data-bs-theme="dark"] .border-gray-300,
            html[data-bs-theme="dark"] .border-b { border-color: #495057 !important; }
            html[data-bs-theme="dark"] .shadow { box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.5), 0 1px 2px 0 rgba(0, 0, 0, 0.3) !important; }
        </style>
        <script>
            if (localStorage.getItem('theme') === 'dark') {
                document.documentElement.setAttribute('data-bs-theme', 'dark');
            }
        </script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Flash Messages -->
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle"></i> {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
            </div>

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

        <!-- SweetAlert2 -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <!-- Stack untuk scripts tambahan dari child view -->
        @stack('scripts')
    </body>
</html>
