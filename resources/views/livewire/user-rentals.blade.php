<div class="container mx-auto px-6 py-10">
    <flux:heading size="xl" class="text-gray-900 dark:text-white">My Rentals</flux:heading>

    @if($rentals->isEmpty())
        <p class="mt-6 text-gray-600 dark:text-gray-400">You haven't rented any vehicles yet.</p>
    @else
        <div class="mt-6 space-y-6">
            @foreach($rentals as $rental)
                <div class="bg-white dark:bg-zinc-800 p-6 shadow-md rounded-lg flex flex-col md:flex-row gap-x-12 gap-y-6">
                    <!-- Vehicle Image -->
                    <img src="{{ asset('images/sedan.png') }}" 
                         class="w-48 h-32 object-contain rounded-lg shadow-md" 
                         alt="Car Image">

                    <!-- Rental Details -->
                    <div class="flex-1">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-white">
                            {{ $rental->vehicle->name }} - {{ $rental->vehicle->year }}
                        </h3>
                        <p class="text-gray-600 dark:text-gray-400">{{ $rental->vehicle->category }} | {{ ucfirst($rental->vehicle->transmission) }}</p>

                        <div class="mt-2">
                            <span class="text-gray-800 dark:text-white font-semibold">Pickup:</span>
                            <span class="text-gray-600 dark:text-gray-300">{{ $rental->pickup_location }}</span>
                        </div>

                        <div class="mt-1">
                            <span class="text-gray-800 dark:text-white font-semibold">Drop-off:</span>
                            <span class="text-gray-600 dark:text-gray-300">{{ $rental->dropoff_location }}</span>
                        </div>

                        <div class="mt-1">
                            <span class="text-gray-800 dark:text-white font-semibold">Rental Period:</span>
                            <span class="text-gray-600 dark:text-gray-300 text-sm">
                                {{ \Carbon\Carbon::parse($rental->start_time)->format('M d, h:i A') }} 
                                - 
                                {{ \Carbon\Carbon::parse($rental->end_time)->format('M d, h:i A') }}
                            </span>
                        </div>
                    </div>

                    <!-- Payment Info -->
                    <div class="flex-1">
                        <h4 class="text-lg font-semibold text-gray-800 dark:text-white">Payment Details</h4>
                        @if($rental->payment)
                            <p class="text-gray-600 dark:text-gray-300">
                                <span class="font-semibold">Amount Paid:</span> ${{ number_format($rental->payment->amount, 2) }}
                            </p>
                            <p class="text-gray-600 dark:text-gray-300">
                                <span class="font-semibold">Payment Method:</span> {{ ucfirst(str_replace('_', ' ', $rental->payment->payment_method)) }}
                            </p>
                            <p class="text-gray-600 dark:text-gray-300">
                                <span class="font-semibold">Status:</span> 
                                <flux:badge variant="{{ $rental->payment->status === 'paid' ? 'success' : 'warning' }}">
                                    {{ ucfirst($rental->payment->status) }}
                                </flux:badge>
                            </p>
                        @else
                            <p class="text-red-500">Payment not found.</p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>