<div class="chat-container flex">
    <div class="user-list w-1/4 border-r p-2">
        <h3 class="font-bold mb-2">Users</h3>
        <ul>
            @foreach ($users as $user)
                <li class="mb-1">
                    <button wire:click="selectUser({{ $user->id }})"
                        class="w-full text-left px-2 py-1 rounded {{ $receiverId === $user->id ? 'bg-blue-200' : 'hover:bg-gray-100' }}">
                        {{ $user->name }}
                    </button>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="chat-window w-3/4 p-2">
        @if (session('error'))
            <div class="text-red-500 mb-2">{{ session('error') }}</div>
        @endif
        @if ($receiverId)
            <div class="messages"
                style="height: 300px; overflow-y: auto; border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;">
                @foreach ($messages as $message)
                    <div class="message {{ $message['sender_id'] === auth()->id() ? 'text-right' : 'text-left' }}">
                        <span class="font-bold">{{ $message['sender_id'] === auth()->id() ? 'You' : 'Them' }}:</span>
                        <span>{{ $message['content'] }}</span>
                        <span class="text-xs text-gray-500 ml-2">{{ $message['time'] ?? '' }}</span>
                    </div>
                @endforeach
            </div>
            <form wire:submit.prevent="sendMessage" class="flex">
                <input type="text" wire:model.defer="newMessage" class="flex-1 border rounded px-2 py-1"
                    placeholder="Type your message...">
                <button type="submit" class="ml-2 px-4 py-1 bg-blue-500 text-white rounded">Send</button>
            </form>
            @error('newMessage')
                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
            @enderror
        @else
            <div class="text-gray-500">Select a user to start chatting.</div>
        @endif
    </div>
</div>
