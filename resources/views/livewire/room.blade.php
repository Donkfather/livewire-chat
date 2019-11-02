<div class="h-full">
    <div wire:offline class="font-bold text-black bg-red-500 py-2 text-center"> You are now offline.</div>
    <div class="flex w-full h-full">
        @livewire('users')
        @livewire('messages')
    </div>
    <script>
    let scrollMessagesWrapper = function () {
      let el = document.getElementById('messagesWrapper');
      let scrollHeight = el.scrollHeight;
      el.scroll({
        top: scrollHeight,
        behavior: 'smooth'
      })
    }
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
        showNotification(e.userName, e.message);
      })
    </script>
</div>
