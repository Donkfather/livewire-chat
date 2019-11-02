<?php

namespace App\Http\Livewire;

use App\User;
use Livewire\Component;

class Users extends Component
{
    public $listeners = [
        'echo:presence-chat,NewUser' => '$refresh',
    ];

    public function render()
    {
        return view('livewire.users', [
            'user'  => auth()->user(),
            'users' => User::where('id', '!=', auth()->id())->get(),
        ]);
    }
}
