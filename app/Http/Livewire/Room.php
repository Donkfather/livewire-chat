<?php

namespace App\Http\Livewire;

use App\Events\NewMessage;
use App\Message;
use App\User;
use Livewire\Component;

class Room extends Component
{
    public function render()
    {
        return view('livewire.room');
    }
}
