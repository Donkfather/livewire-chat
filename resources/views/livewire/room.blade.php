<div class="h-full">
    <style>
        .drawer {
            transform: translate(-100%, 0);
            transition: 0.5s ease-in-out;
        }

        .drawer.open {
            transform: translate(0, 0);
        }
    </style>
    <div wire:offline class="font-bold text-black bg-red-500 py-2 text-center"> You are now offline.</div>
    <div
        class="sm:hidden drawer absolute top-0 left-0 z-20 drawer w-full h-full bg-gray-200"
        data-drawer="users"
        style="max-width:300px">
        @livewire('users')
    </div>
    <div class="flex w-full h-full">
        <div class="hidden sm:block bg-gray-200">
            @livewire('users')
        </div>
        <div class="flex flex-col w-full">
            <div class="h-12 px-2 flex-shrink-0 flex items-center justify-end border-b">
                <button id="burgerButton" class="sm:hidden focus:outline-none drawer-trigger" onclick="drawer.toggle()">
                    <svg
                        class="pointer-events-none w-6 h-auto text-black fill-current"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/>
                    </svg>
                </button>
                <a class="text-xs ml-auto" href="{{route('logout')}}">LOGOUT</a>
            </div>
            <div class="flex h-full">
                @livewire('messages')
                <div class="hidden lg:block flex w-1/4"></div>
            </div>
        </div>
    </div>
    <audio src="/assets/sound.mp3" id="new-message-alert"></audio>
    <script>
    window.Echo.join('chat')
      .listen('NewMessage', e => {
        scrollMessagesWrapper()
        if (document.hidden) {
          document.getElementById('new-message-alert').play()
        }
        showNotification(e.userName, e.message);
      })
    </script>
</div>
