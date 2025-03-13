<x-layouts.app title="Home">
    <h1 class="text-3xl font-bold">Welcome to MyApp</h1>
    <p class="text-gray-700 mt-2">This is a test page with Livewire and Alpine.js.</p>

    <p class="text-gray-700 mt-2">Now powered by Flux UI!</p>
    <img src="images/black-audi.avif" width="300" class="hidden dark:block"  />
    <img src="images/white-audi.avif" width="300" class="block dark:hidden"  />
    <flux:button>Button</flux:button>
</x-layouts.app>