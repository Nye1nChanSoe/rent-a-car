<div class="container mx-auto px-6 grid grid-cols-1 md:grid-cols-2 gap-6">

    <!-- Booking Form -->
    <div class="bg-white dark:bg-black p-6 shadow-md rounded-lg">
        <flux:heading size="xl" class="mb-4">Rent a car</flux:heading>

        <form wire:submit.prevent="filterAvailableVehicles" class="space-y-4">
            <flux:input wire:model.debounce.500ms="pickupLocation" label="Pickup Location" placeholder="Enter pickup location" required />
            <flux:input wire:model.debounce.500ms="dropoffLocation" label="Drop-off Location" placeholder="Enter drop-off location" required />

            <div class="grid grid-cols-2 gap-4">
                <flux:input wire:model.debounce.500ms="startTime" type="datetime-local" label="Start Time" required />
                <flux:input wire:model.debounce.500ms="endTime" type="datetime-local" label="End Time" required />
            </div>

            <flux:select wire:model.debounce.500ms="ageRange" label="Driver's Age Range" required>
                <option value="">Select age range</option>
                <option value="18-24">18-24</option>
                <option value="25-34">25-34</option>
                <option value="35-50">35-50</option>
                <option value="50+">50+</option>
            </flux:select>

            <flux:button type="submit" variant="primary" class="w-full">Find Available Cars</flux:button>
        </form>
    </div>

    <!-- Vehicles List (Scrollable) -->
    <div class="bg-white dark:bg-black p-6 shadow-md rounded-lg overflow-y-auto max-h-[600px]">
        <flux:heading size="xl" class="mb-4">Available Vehicles</flux:heading>

        @if(!empty($availableVehicles))
            <div class="space-y-4">
                @foreach ($availableVehicles as $vehicle)
                    <livewire:vehicle-card :vehicle="$vehicle" />
                @endforeach
            </div>
        @else
            <p class="text-zinc-600 dark:text-zinc-300 text-center">No cars available for the selected time.</p>
        @endif
    </div>
</div>
