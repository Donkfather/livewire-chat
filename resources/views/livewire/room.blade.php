<div class="h-full">
    <div wire:offline class="font-bold text-black bg-red-500 py-2 text-center"> You are now offline.</div>
    <div class="flex w-full h-full">
        @livewire('users')
        <div class="flex flex-col w-full">
            <div class="h-12 flex-shrink-0 flex items-center justify-end pr-2">
                <a class="text-xs ml-auto" href="{{route('logout')}}">LOGOUT</a>
            </div>
            <div class="flex h-full">
                @livewire('messages')
                <div class="flex w-1/4"></div>
            </div>
        </div>
    </div>
    <audio src="/assets/sound.mp3" id="new-message-alert"></audio>
    <script>
    let scrollMessagesWrapper = function () {
      let el = document.getElementById('messagesWrapper');
      let scrollHeight = el.scrollHeight;
      el.scroll({
        top: scrollHeight,
        behavior: 'smooth'
      })
    }
    Notification.requestPermission();
    let showNotification = function (name, text) {
      if (Notification.permission === 'granted' && document.hidden) {
        let n = new Notification(`${name} wrote:`, {
          body: text
        })
      }
    }

    scrollMessagesWrapper();
    window.Echo.join('chat')
      .listen('NewMessage', e => {
        scrollMessagesWrapper()
        if(document.hidden){
          document.getElementById('new-message-alert').play()
        }
        showNotification(e.userName, e.message);
      })
    </script>
</div>
