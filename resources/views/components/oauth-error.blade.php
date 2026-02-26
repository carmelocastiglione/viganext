@if (session('error'))
    <flux:text class="mt-4 text-center text-red-600 dark:text-red-400 text-sm">
        {{ session('error') }}
    </flux:text>
@endif