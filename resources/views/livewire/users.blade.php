<div class="w-64 bg-gray-200 h-full p-4 hidden sm:block">
    <div class="mt-3 flex mb-5 items-center">
        <img src="{{$user->avatar ?? 'https://icon-library.net/images/default-user-icon/default-user-icon-4.jpg'}}"
             alt="user img"
             class="w-8 h-8 mr-2 rounded-full border-2 border-orange-300"
        >
        <span class="text-green-500">
            {{$user->name}}
        </span>
    </div>
    @foreach($users as $people)
        <div class="mt-3 flex mb-5 items-center">
            <img
                src="{{$people->avatar ?? 'https://icon-library.net/images/default-user-icon/default-user-icon-4.jpg'}}"
                alt="user img"
                class="w-8 h-8 mr-2 rounded-full border-2 border-orange-300"
            >
            <span class="@if($user && $user->id == $people->id) {{'text-green-500'}} @endif">
                {{$people->name}}
            </span>
        </div>
    @endforeach
</div>
