<?php

namespace App\Livewire;

use App\Models\Vehicle;
use Livewire\Component;

class VehicleCard extends Component
{
    public Vehicle $vehicle;

    public bool $showModal = false;

    public function showDetails()
    {
        $this->showModal = true;
    }

    public function hideDetails()
    {
        $this->showModal = false;
    }

    public function render()
    {
        return view('livewire.vehicle-card');
    }
}
