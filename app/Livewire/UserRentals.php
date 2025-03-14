<?php

namespace App\Livewire;

use App\Models\Rental;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UserRentals extends Component
{
    public function render()
    {
        $rentals = Rental::where('user_id', Auth::id())
            ->with(['vehicle', 'payment'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('livewire.user-rentals', compact('rentals'));
    }
}
