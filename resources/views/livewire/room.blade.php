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

    scrollMessagesWrapper();
    window.Echo.channel('chat')
      .listen('NewMessage', e => {
        scrollMessagesWrapper()
      })
    </script>
</div>
