<?php

namespace App\Http\Livewire;

use App\Events\NewMessage;
use App\Message;
use App\User;
use Livewire\Component;

class Room extends Component
{
    public $message = '';

    public $listeners = [
        'echo:messages,NewMessage'              => '$refresh',
    ];

    public function updatedMessage()
    {
        $this->validate([
            'message' => 'min:1|max:250'
        ]);
    }

    public function sendMessage()
    {
        $this->validate([
            'message' => 'required|min:1|max:250',
        ]);

        Message::create([
            'user_id' => auth()->id() ?? 1,
            'text'    => $this->message,
        ]);
        event(new NewMessage);

        $this->message = '';

        $this->emit('new-message');
    }

    public function render()
    {
        return view('livewire.room', [
            'messages' => Message::latest()->take(10)->with('user')->get()->sortBy('created_at'),
            'users'    => User::all(),
            'user'     => auth()->user(),
        ]);
    }
}
