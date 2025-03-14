<?php

namespace App\Livewire;

use App\Enums\PaymentMethod;
use App\Enums\PaymentStatus;
use App\Enums\RentalStatus;
use App\Enums\VehicleStatus;
use App\Models\Payment;
use App\Models\Rental;
use App\Models\Vehicle;
use Illuminate\Database\QueryException;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class ShowRental extends Component
{
    public Vehicle $vehicle;
    public Rental $onGoingRental;

    public ?string $pickupLocation = null;
    public ?string $dropoffLocation = null;
    public ?string $startTime = null;
    public ?string $endTime = null;
    public string $paymentMethod = '';

    public float $totalPrice = 0.0;
    public int $totalDays = 1;
    public int $step = 1;

    public function mount(Vehicle $vehicle)
    {
        $this->vehicle = $vehicle;
        $this->onGoingRental = Rental::where('user_id',Auth::id())
            ->where('vehicle_id', $vehicle->id)
            ->where('status', RentalStatus::SELECTED->value)
            ->first();

        if ($this->onGoingRental)
        {
            $this->pickupLocation = $this->onGoingRental->pickup_location ?? '';
            $this->dropoffLocation = $this->onGoingRental->dropoff_location ?? '';
            $this->startTime = $this->onGoingRental->start_time ?? '';
            $this->endTime = $this->onGoingRental->end_time ?? '';
        }

        $this->updateTotalPrice();
    }

    public function updated($property)
    {
        if (in_array($property, ['startTime', 'endTime'])) {
            $this->updateTotalPrice();
        }
    }

    public function nextStep()
    {
        $this->validate([
            'pickupLocation' => ['required', 'string'],
            'dropoffLocation' => ['required', 'string'],
            'startTime' => ['required', 'date', 'after:now'],
            'endTime' => ['required', 'date', 'after:startTime'],
        ]);

        $this->onGoingRental->update([
            'pickup_location' => $this->pickupLocation,
            'dropoff_location' => $this->dropoffLocation,
            'start_time' => $this->startTime,
            'end_time' => $this->endTime,
        ]);

        $this->step = 2;
    }

    public function previousStep()
    {
        $this->step = 1;
    }


    public function completeBooking()
    {
        try {
            DB::beginTransaction();
            $this->onGoingRental->update([
                'status' => RentalStatus::PENDING->value,
            ]);
            $this->vehicle->update([
                'status' => VehicleStatus::BOOKED->value,
            ]);
            Payment::firstOrCreate(
                ['rental_id' => $this->onGoingRental->id],
                [
                    'amount' => $this->totalPrice,
                    'payment_method' => PaymentMethod::CREDIT_CARD->value,
                    'status' => PaymentStatus::SUCCESS->value,
                ]
            );
            DB::commit();
            return redirect()->route('profile.rents')->with('status', 'Booking completed successfully!');
        } catch (QueryException $e) {
            DB::rollBack();
            Log::error('Booking Transaction Failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong! Please try again.');
        }
    }

    public function render()
    {
        return view('livewire.show-rental');
    }

    private function updateTotalPrice()
    {
        if ($this->startTime && $this->endTime) {
            $start = Carbon::parse($this->startTime);
            $end = Carbon::parse($this->endTime);
            $this->totalDays = max($start->diffInDays($end), 1);
            $this->totalPrice = $this->vehicle->price_per_day * $this->totalDays;
        } else {
            $this->totalPrice = $this->vehicle->price_per_day;
        }
    }
}
