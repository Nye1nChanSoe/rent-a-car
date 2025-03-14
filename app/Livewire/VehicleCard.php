<?php

namespace App\Livewire;

use App\Enums\RentalStatus;
use App\Enums\VehicleStatus;
use App\Models\Rental;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Url;
use Livewire\Component;

class VehicleCard extends Component
{
    public Vehicle $vehicle;

    #[Url(as: 'pick-up')]
    public ?string $pickupLocation = null;

    #[Url(as: 'drop-off')]
    public ?string $dropoffLocation = null;

    #[Url(as: 'from')]
    public ?string $startTime = null;

    #[Url(as: 'to')]
    public ?string $endTime = null;

    #[Url(as: 'age')]
    public ?string $ageRange = "";

    public function proceed(Vehicle $vehicle)
    {
        if (!Auth::check())
        {
            $this->dispatch('show-toast', 'You need to log in before continue', 'info');
            return redirect()->route('login');
        }

        // check profile complete
        if (!Auth::user()->profile || !Auth::user()->profile->is_completed) {
            $this->dispatch('show-toast', 'Please complete the profile', 'info');
            return redirect()->route('profile');
        }

        // TODO: debug
        Log::info($this->pickupLocation);
        Log::info($this->dropoffLocation);
        Log::info($this->startTime);
        Log::info($this->endTime);
        Log::info($this->ageRange);

        if ($vehicle->status !== VehicleStatus::AVAILABLE->value) {
            return $this->redirect(url()->previous());
        }

        Rental::firstOrCreate(
            [
                'user_id' => Auth::id(),
                'vehicle_id' => $vehicle->id,
            ],
            [
                'start_time' => $this->startTime,
                'end_time' => $this->endTime,
                'pickup_location' => $this->pickupLocation,
                'dropoff_location' => $this->dropoffLocation,
                'status' => RentalStatus::SELECTED->value,
            ]
        );

        return $this->redirect("/rent-a-car/{$vehicle->id}");
    }

    public function render()
    {
        return view('livewire.vehicle-card');
    }
}
