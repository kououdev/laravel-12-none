<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors" />
    <meta name="generator" content="Hugo 0.84.0" />
    <title>{{ $title . ' - ' . config('app.name', 'APP') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body>
    {{-- Header --}}
    @include('partials.header')

    <div class="container-fluid">
        <div class="row">
            {{-- Sidebar --}}
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                @include('partials.sidebar')
            </nav>

            {{-- Content --}}
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                {{ $slot }}
            </main>
        </div>
    </div>

    {{-- Footer --}}
    @include('partials.footer')

    @livewireScripts

    {{-- Global Feather Icons Initialization --}}
    <script>
        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            if (window.feather) {
                feather.replace();
            }
        });

        // Reinitialize after Livewire updates
        document.addEventListener('livewire:updated', function() {
            if (window.feather) {
                feather.replace();
            }
        });

        // For Livewire navigation
        document.addEventListener('livewire:navigated', function() {
            if (window.feather) {
                feather.replace();
            }
        });
    </script>
</body>

</html>
