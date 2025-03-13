<?php

namespace App\Livewire;

use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Url;
use Livewire\Attributes\Validate;
use Livewire\Component;

class RentACar extends Component
{
    #[Validate('required', 'string')]
    #[Url(as: 'pick-up')]
    public string $pickupLocation = "";

    #[Validate('required', 'string')]
    #[Url(as: 'drop-off')]
    public string $dropoffLocation = "";

    #[Validate('required', 'date', 'after:now')]
    #[Url(as: 'from')]
    public string $startTime = "";

    #[Validate('required', 'date', 'after:startTime')]
    #[Url(as: 'to')]
    public string $endTime = "";

    #[Validate('required', 'string')]
    #[Url(as: 'age')]
    public string $ageRange = "";

    public Collection $availableVehicles;

    public function filterAvailableVehicles()
    {
        if (!$this->pickupLocation || !$this->dropoffLocation || !$this->startTime || !$this->endTime) {
            return;
        }

        $this->availableVehicles = Vehicle::where('status', 'available')
            ->orderBy('price_per_day')
            ->get();

        Log::info($this->availableVehicles);
    }

    public function render()
    {
        return view('livewire.rent-a-car');
}
}
