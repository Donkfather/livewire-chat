<div class="h-full">
    <div wire:offline class="font-bold text-black bg-red-500 py-2 text-center"> You are now offline. </div>
    <div class="flex w-full h-full">
        <div wire:poll.300ms class="w-64 bg-gray-200 h-full p-4">
            @foreach($users as $people)
                <div class="flex mb-5 items-center">
                    <img src="https://icon-library.net/images/default-user-icon/default-user-icon-4.jpg"
                         alt="user img"
                         class="w-8 h-8 mr-3 rounded-full border-2 border-orange-300"
                    >
                    <span class="text-lg font-bold @if($user && $user->id == $people->id) {{'text-green-500'}} @endif">
                        {{$people->name}}
                    </span>
                </div>
            @endforeach
        </div>
        <div class="flex flex-col w-full">
            <div class="flex-1 flex flex-col px-5 py-2 h-full">
                <h2 class="font-bold mb-4">Messages ({{$messages->count()}})</h2>
                <div wire:poll.200ms class="h-full overflow-y-scroll">
                    @foreach ($messages as $message)
                        @if($user && $user->id == $message->user_id)
                            <div class="flex flex-row-reverse ml-auto">
                                <img src="https://icon-library.net/images/default-user-icon/default-user-icon-4.jpg"
                                     alt="user img"
                                     class="w-6 h-6 rounded-full border-2 border-orange-300"
                                >
                                <p class="mt-6 py-2 px-3 bg-blue-200 rounded-lg mb-4">{{ $message->text }}</p>
                            </div>
                        @else
                            <div class="flex">
                                <img src="https://icon-library.net/images/default-user-icon/default-user-icon-4.jpg"
                                     alt="user img"
                                     class="w-6 h-6 rounded-full border-2 border-orange-300"
                                >
                                <p class="mt-6 py-2 px-3 bg-gray-200 rounded-lg mb-4">{{ $message->text }}</p>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="bg-gray-700 w-full align-self-end px-4 py-2">
                <form action="" wire:submit.prevent="sendMessage" class="flex">
                    <input type="text"
                           wire:model="message"
                           placeholder="Write your message here..."
                           class="w-full rounded-lg h-12 mr-3 px-3"
                    />
                    <input type="submit"
                           class="bg-blue-400 px-3 rounded-lg text-white font-bold"
                           value="Send"
                    >
                </form>
            </div>
        </div>
    </div>
</div>
