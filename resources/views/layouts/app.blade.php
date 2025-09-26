<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body>
    {{-- Header --}}
    @include('partials.header')

    <div class="container-fluid">
        <div class="row">
            {{-- Sidebar --}}
            <div class="col-2">
                @include('partials.sidebar')
            </div>

            {{-- Content --}}
            <div class="col-10">
                {{ $slot }}
            </div>
        </div>
    </div>

    {{-- Footer --}}
    @include('partials.footer')

    @livewireScripts
</body>

</html>
