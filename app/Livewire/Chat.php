<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Message;
use App\Models\User;
use App\Jobs\SendMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class Chat extends Component
{
    public $messages = [];
    public $newMessage = '';
    public $users = [];
    public $receiverId = null;

    protected $rules = [
        'newMessage' => 'required|string|max:1000',
    ];

    public function mount()
    {
        $userId = auth()->id();
        // Get all users except the current user
        $this->users = User::where('id', '!=', $userId)->get();
        $this->messages = [];
    }

    public function selectUser($userId)
    {
        $this->receiverId = $userId;
        $this->loadMessages();
    }

    public function loadMessages()
    {
        $userId = auth()->id();
        $this->messages = Message::where(function ($q) use ($userId) {
            $q->where('sender_id', $userId)->where('receiver_id', $this->receiverId);
        })->orWhere(function ($q) use ($userId) {
            $q->where('sender_id', $this->receiverId)->where('receiver_id', $userId);
        })->orderBy('created_at')->get()->toArray();
    }

    public function sendMessage()
    {
        $this->validate();
        $userId = auth()->id();
        if (!$this->receiverId) return;
        if (!$userId) {
            session()->flash('error', 'You must be logged in to send messages.');
            return;
        }
        $message = new Message();
        $message->sender_id = $userId;
        $message->receiver_id = $this->receiverId;
        $message->content = $this->newMessage;
        $message->save();
        SendMessage::dispatch($message);
        $this->messages[] = $message->toArray();
        $this->newMessage = '';
    }

    protected function getListeners()
    {
        $userId = auth()->id();
        return [
            "echo-private:chat.{$userId},GotMessage" => 'receiveMessage',
        ];
    }

    public function receiveMessage($payload)
    {
        Log::info('Livewire receiveMessage triggered', ['payload' => $payload]);
        // Only add the message if it's from/to the selected user
        if (
            ($payload['sender_id'] == $this->receiverId && $payload['receiver_id'] == auth()->id()) ||
            ($payload['sender_id'] == auth()->id() && $payload['receiver_id'] == $this->receiverId)
        ) {
            $this->messages[] = $payload;
        }
    }

    public function render()
    {
        return view('livewire.chat');
    }
}
