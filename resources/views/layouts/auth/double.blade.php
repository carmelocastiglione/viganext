<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen antialiased">
        <div class="min-h-screen flex flex-col items-center justify-center p-4">
            <div class="w-full">
                {{ $slot }}
            </div>
        </div>
        @fluxScripts
    </body>
</html>
