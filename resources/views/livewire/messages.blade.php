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
                            <p class="py-2 px-3 bg-blue-500 text-white rounded-lg mb-4 whitespace-pre-wrap shadow">{{ $message->text }}</p>
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
                            <p class="py-2 px-3 bg-gray-200 rounded-lg mb-4 whitespace-pre-wrap shadow">{{ $message->text }}</p>
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
        <form action="" wire:submit.prevent.stop="" class="flex items-start">
            <div class="relative w-full">
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
            <button
                   wire:click="sendMessage"
                   class="block h-12 sm:hidden cursor-pointer ml-3 bg-blue-400 px-3 rounded-lg text-white font-bold"
            >
                <svg
                    class="text-white h-6 fill-current"
                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><defs/><path d="M506.955 1.314c-3.119-1.78-6.955-1.75-10.045.078L313.656 109.756c-4.754 2.811-6.329 8.943-3.518 13.697 2.81 4.753 8.942 6.328 13.697 3.518l131.482-77.749-244.906 254.113-121.808-37.266 158.965-94c4.754-2.812 6.329-8.944 3.518-13.698-2.81-4.753-8.943-6.33-13.697-3.518L58.91 260.392c-3.41 2.017-5.309 5.856-4.84 9.791s3.216 7.221 7.004 8.38l145.469 44.504L270.72 439.88c.067.121.136.223.207.314 1.071 1.786 2.676 3.245 4.678 4.087 1.253.527 2.57.784 3.878.784 2.563 0 5.086-.986 6.991-2.849l73.794-72.12 138.806 42.466c.96.293 1.945.438 2.925.438 2.116 0 4.206-.672 5.948-1.961C510.496 409.153 512 406.17 512 403V10c0-3.591-1.926-6.907-5.045-8.686zM271.265 329.23c-1.158 1.673-1.779 3.659-1.779 5.694v61.171l-43.823-79.765 193.921-201.21-148.319 214.11zm18.221 82.079v-62.867l48.99 14.988-48.99 47.879zM492 389.483l-196.499-60.116L492 45.704v343.779z"/><path d="M164.423 347.577c-3.906-3.905-10.236-3.905-14.143 0l-93.352 93.352c-3.905 3.905-3.905 10.237 0 14.143C58.882 457.024 61.441 458 64 458s5.118-.976 7.071-2.929l93.352-93.352c3.905-3.904 3.905-10.236 0-14.142zM40.071 471.928c-3.906-3.903-10.236-3.903-14.142.001l-23 23c-3.905 3.905-3.905 10.237 0 14.143C4.882 511.024 7.441 512 10 512s5.118-.977 7.071-2.929l23-23c3.905-3.905 3.905-10.237 0-14.143zM142.649 494.34c-1.859-1.86-4.439-2.93-7.069-2.93-2.641 0-5.21 1.07-7.07 2.93-1.86 1.86-2.93 4.43-2.93 7.07 0 2.63 1.069 5.21 2.93 7.07 1.86 1.86 4.44 2.93 7.07 2.93s5.21-1.07 7.069-2.93c1.86-1.86 2.931-4.44 2.931-7.07 0-2.64-1.07-5.21-2.931-7.07zM217.051 419.935c-3.903-3.905-10.233-3.905-14.142 0l-49.446 49.445c-3.905 3.905-3.905 10.237 0 14.142 1.953 1.953 4.512 2.929 7.071 2.929s5.118-.977 7.071-2.929l49.446-49.445c3.905-3.905 3.905-10.237 0-14.142zM387.704 416.139c-3.906-3.904-10.236-3.904-14.142 0l-49.58 49.58c-3.905 3.905-3.905 10.237 0 14.143 1.953 1.952 4.512 2.929 7.071 2.929s5.118-.977 7.071-2.929l49.58-49.58c3.905-3.905 3.905-10.237 0-14.143zM283.5 136.31c-1.86-1.86-4.44-2.93-7.07-2.93s-5.21 1.07-7.07 2.93c-1.859 1.86-2.93 4.44-2.93 7.08 0 2.63 1.07 5.2 2.93 7.06 1.86 1.87 4.44 2.93 7.07 2.93s5.21-1.06 7.07-2.93c1.859-1.86 2.93-4.43 2.93-7.06 0-2.64-1.07-5.22-2.93-7.08z"/></svg>
            </button>
        </form>
    </div>
</div>
