<x-layouts.app title="Vehicles">
    <div class="py-16 bg-zinc-50 dark:bg-zinc-900">
        <div class="container mx-auto px-6">
            <flux:heading size="xl" class="text-center font-bold text-zinc-800 dark:text-white">Available Vehicles</flux:heading>
            <div class="mt-10 grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach ($vehicles as $vehicle)
                    <livewire:vehicle-card :vehicle="$vehicle" />
                @endforeach
            </div>
        </div>
    </div>
</x-layouts.app>