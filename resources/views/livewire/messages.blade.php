<div class="flex flex-col w-full h-full">
    <div class="flex-1 flex flex-col pl-3 py-2 h-full">
        <div id="messagesWrapper" class="h-full overflow-y-auto pr-2">
            @foreach ($messages as $message)
                @if($user && $user->id == $message->user_id)
                    <div class="flex flex-row-reverse ml-auto">
                        <img
                            src="{{$message->user->avatar ?? 'https://icon-library.net/images/default-user-icon/default-user-icon-4.jpg'}}"
                            alt="user img"
                            class="w-6 h-6 rounded-full border-2 border-orange-300"
                        >
                        <div class="flex flex-col mr-2 items-end pt-1">
                            <span class="text-xs text-gray-500 text-right mb-2">{{$message->user->name}}</span>
                            <p class="py-2 px-3 bg-blue-200 rounded-lg mb-4 whitespace-pre-wrap">{{ $message->text }}</p>
                        </div>
                    </div>
                @else
                    <div class="flex">
                        <img
                            src="{{$message->user->avatar ?? 'https://icon-library.net/images/default-user-icon/default-user-icon-4.jpg'}}"
                            alt="user img"
                            class="w-6 h-6 rounded-full border-2 border-orange-300"
                        >
                        <div class="flex flex-col items-start ml-2 pt-1">
                            <span class="mb-2 text-xs text-gray-500">{{$message->user->name}}</span>
                            <p class="py-2 px-3 bg-gray-200 rounded-lg mb-4 whitespace-pre-wrap">{{ $message->text_as_html }}</p>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
    <div class="bg-gray-700 w-full align-self-end px-4 py-2">
        @error('message')
        <div class="text-red-500">
            {{$message}}
        </div>
        @enderror
        <form action="" wire:submit.prevent.stop="">
            <div class="relative">
                <textarea class="w-full rounded-lg h-12 py-3 px-3 "
                          style="min-height: 50px;max-height: 80px;min-width: 100%; white-space: pre-wrap"
                      placeholder="Write your message here..."
                      wire:keyup.ctrlKey.enter="sendMessage"
                      wire:model="message"
                ></textarea>
                <div class="absolute bottom-0 right-0 mb-2 mr-2 text-gray-500 text-xs">
                    Use ctrl+enter to send
                </div>
            </div>
            <input type="button"
                   wire:click="sendMessage"
                   class="block sm:hidden cursor-pointer ml-3 bg-blue-400 px-3 rounded-lg text-white font-bold"
                   value="Send"
            >
        </form>
    </div>
</div>
