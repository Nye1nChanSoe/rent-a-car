<div class="bg-white dark:bg-black shadow-md rounded-lg overflow-hidden transition-transform duration-300 hover:scale-[1.02] border border-neutral-200 dark:border-neutral-700">

    <!-- Card Header -->
    <div class="relative p-4">
        <flux:button icon="information-circle" variant="subtle" size="sm" class="absolute top-3 left-3" wire:click="showDetails">
            Details
        </flux:button>
    </div>

    <!-- Vehicle Image -->
    <img src="{{ asset('images/sedan.png') }}" class="w-full h-48 object-cover rounded-t-lg" />

    <!-- Vehicle Info -->
    <div class="p-4 text-center">
        <h3 class="text-xl font-semibold text-zinc-800 dark:text-white">{{ $vehicle->name }} - {{ $vehicle->year }}</h3>

        <div class="flex justify-center items-center gap-4 mt-3 text-zinc-600 dark:text-zinc-300">
            <span class="flex items-center gap-1"><flux:icon.users class="size-5" /> {{ $vehicle->seats }}</span>
            <span class="flex items-center gap-1"><flux:icon.briefcase class="size-5" /> {{ $vehicle->luggage_capacity }}</span>
            <span class="flex items-center gap-1"><flux:icon.cog class="size-5" /> {{ strtoupper(substr($vehicle->transmission, 0, 1)) }}</span>
            <span class="flex items-center gap-1"><flux:icon.fuel class="size-5" /> {{ strtoupper(substr($vehicle->fuel_type, 0, 1)) }}</span>
        </div>

        <!-- Price & Select Button -->
        <div class="mt-4 border-t pt-4">
            <div class="text-2xl font-bold text-primary">${{ number_format($vehicle->price_per_day, 2) }} <span class="text-sm">NZD</span></div>
            <flux:button class="w-full mt-2" variant="primary" wire:click="showDetails">Select</flux:button>
        </div>
    </div>

    <!-- Modal for Detailed View -->
    <flux:modal wire:model="showModal">
        <div>
            <h3 class="text-xl font-semibold">{{ $vehicle->name }} - {{ $vehicle->year }}</h3>
            <p class="text-sm text-zinc-500">{{ $vehicle->model }}</p>
        </div>

        <div>
            <img src="{{ asset('images/sedan.png') }}" class="w-full h-64 object-cover rounded-lg" />

            <div class="mt-4 flex flex-wrap gap-2">
                @foreach ($vehicle->features as $feature)
                    <flux:badge>{{ $feature }}</flux:badge>
                @endforeach
            </div>

            <div class="mt-6">
                <h4 class="text-lg font-semibold">Pricing Details</h4>
                <div class="bg-zinc-100 dark:bg-zinc-800 p-4 rounded-lg">
                    <div class="flex justify-between">
                        <span>Base Rate</span>
                        <span>${{ number_format($vehicle->price_per_day - 20, 2) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Tax</span>
                        <span>${{ number_format($vehicle->price_per_day, 2) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Insurance</span>
                        <span>$10.00</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Cleaning Fee</span>
                        <span>$5.00</span>
                    </div>
                    <div class="border-t mt-3 pt-3 font-bold text-lg flex justify-between">
                        <span>Total</span>
                        <span>${{ number_format($vehicle->price_per_day, 2) }}</span>
                    </div>
                </div>
            </div>

            <!-- More Details -->
            {{-- <flux:accordion class="mt-6">
                <flux:accordion.item title="Specifications">
                    <p>{{ $vehicle->remarks ?? 'No additional specifications available.' }}</p>
                </flux:accordion.item>
                <flux:accordion.item title="Terms and Conditions">
                    <p>Full insurance and terms apply. Make sure to read the policies before booking.</p>
                </flux:accordion.item>
                <flux:accordion.item title="Additional Information">
                    <p>Contact us for any special requests or more details.</p>
                </flux:accordion.item>
            </flux:accordion> --}}
        </div>

        <div>
            <flux:button class="w-full" variant="primary">Proceed</flux:button>
        </div>
    </flux:modal>
</div>
