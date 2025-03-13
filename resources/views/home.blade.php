<x-layouts.app title="Home">
    <div class="relative w-full h-screen flex items-center justify-center bg-gradient-to-b from-zinc-900 to-black dark:bg-black text-white">
        <div class="absolute inset-0 bg-cover bg-center opacity-20" style="background-image: url('{{ asset('images/sedan.png') }}');"></div>

        <div class="relative z-10 text-center max-w-3xl mx-auto px-6">
            <flux:heading size="xl" class="font-extrabold text-white">Drive Your Dream Car Today</flux:heading>
            <p class="text-lg text-zinc-300 mt-4">Experience luxury and comfort with our premium car rental service. Affordable rates, top-tier models, and seamless booking.</p>
            <div class="mt-6">
                <flux:button href="/rent-a-car" variant="primary" class="px-6 py-3 text-lg">Book Now</flux:button>
                <flux:button href="/vehicles" variant="outline" class="ml-4 px-6 py-3 text-lg text-white">Browse Cars</flux:button>
            </div>
        </div>
    </div>

    <div class="py-16 bg-white dark:bg-zinc-900">
        <div class="container mx-auto px-6 text-center">
            <flux:heading size="xl" class="font-bold text-zinc-800 dark:text-white">Why Choose Us?</flux:heading>
            <p class="text-lg text-zinc-600 dark:text-zinc-300 mt-4">We offer the best car rental service with flexible plans and top-tier support.</p>

            <div class="mt-10 grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="p-6 bg-zinc-100 dark:bg-zinc-800">
                    <flux:icon.car-front class="text-primary size-10 mx-auto" />
                    <h3 class="text-xl font-semibold mt-4">Wide Selection</h3>
                    <p class="text-zinc-600 dark:text-zinc-300 mt-2">Choose from luxury sedans, SUVs, and sports cars.</p>
                </div>

                <div class="p-6 bg-zinc-100 dark:bg-zinc-800">
                    <flux:icon.clock class="text-primary size-10 mx-auto" />
                    <h3 class="text-xl font-semibold mt-4">24/7 Support</h3>
                    <p class="text-zinc-600 dark:text-zinc-300 mt-2">We're here for you anytime, anywhere.</p>
                </div>

                <div class="p-6 bg-zinc-100 dark:bg-zinc-800">
                    <flux:icon.circle-dollar-sign class="text-primary size-10 mx-auto" />
                    <h3 class="text-xl font-semibold mt-4">Best Prices</h3>
                    <p class="text-zinc-600 dark:text-zinc-300 mt-2">Get the best deals on high-end vehicles.</p>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>