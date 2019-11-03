<div class="w-64 h-full p-4 overflow-y-auto">
    <div class="mt-3 flex mb-5 items-center">
        <img src="{{$user->avatar ?? 'https://icon-library.net/images/default-user-icon/default-user-icon-4.jpg'}}"
             alt="user img"
             class="w-8 h-8 mr-2 rounded-full border-2 border-green-600"
        >
        <span class="text-green-500">
            {{$user->name}}
        </span>
    </div>
    @foreach($users as $people)
        <div class="mt-3 flex mb-5 items-center" data-online="{{$people->id}}">
            <img
                src="{{$people->avatar ?? 'https://icon-library.net/images/default-user-icon/default-user-icon-4.jpg'}}"
                alt="user img"
                class="w-8 h-8 mr-2 rounded-full border-2 border-orange-300"
            >
            <span class="@if($user->id == $people->id) {{'text-green-500'}} @endif">
                {{$people->name}}
            </span>
        </div>
    @endforeach
    <script>
    function mark(el, state) {
      switch (state) {
        case 'online' :
          el.classList.add('border-green-600')
          return;
        case 'offline':
          el.classList.remove('border-green-600')
          return;
      }
    }

    window.Echo.join('chat')
      .here(users => {
        let userIds = _.map(users, 'id');
        let userEls = document.querySelectorAll("[data-online]")
        userEls.forEach(el => {
          let img = el.getElementsByTagName('img')[0];
          if (userIds.includes(parseInt(el.dataset['online']))) {
            mark(img, 'online');
          } else {
            mark(img, 'offline');
          }
        })
      })
      .joining(({id}) => {
        let el = document.querySelector(`[data-online="${id}"]>img`)
        if(el){
          mark(el, 'online');
        }
      })
      .leaving(({id}) => {
        let el = document.querySelector(`[data-online="${id}"]>img`)
        if(el) {
          mark(el, 'offline');
        }
      });
    </script>
</div>
