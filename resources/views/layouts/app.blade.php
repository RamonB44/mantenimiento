<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="icon" type="image/x-icon" href="/img/logo.png">
        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles

        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    </head>
    <body class="font-sans antialiased">
        <x-jet-banner />

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                <div class="flex items-center justify-center p-6 overflow-y-hidden font-sans bg-gray-100 min-w-screen min-h-3/4">
                    {{ $slot }}
                </div>
            </main>
        </div>

        @stack('modals')

        @livewireScripts

        <script>
            /*------Alerta para registro----------------------------------------------------*/
            Livewire.on('alerta', data =>{
                Swal.fire({
                    position: data[0],
                    icon: data[1],
                    title: data[2],
                    showConfirmButton: false,
                    timer: 1000
                })
            });
            Livewire.on('check_all', () =>{
                checkboxes = document.getElementsByName('check_tarea');
                for(var i=0;i<checkboxes.length;i++) {
                    checkboxes[i].checked = true;
                }
            });

            Livewire.on('checkout_all', () =>{
                checkboxes = document.getElementsByName('check_tarea');
                for(var i=0;i<checkboxes.length;i++) {
                    checkboxes[i].checked = false;
                }
            });


        </script>

    </body>
</html>
