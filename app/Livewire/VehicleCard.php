<?php

namespace App\Livewire;

use App\Models\Vehicle;
use Livewire\Component;

class VehicleCard extends Component
{
    public Vehicle $vehicle;

    public function render()
    {
        return view('livewire.vehicle-card');
    }
}
