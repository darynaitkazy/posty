@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12">
            <img src="/uploads/avatars/{{ $user->avatar }}" style="width: 130px; height: 130px; float:left; border-radius: 50%; margin-right: 25px;">
            <div class="p-6">
                <h1 class="text-2xl font-medium mb-1">{{ $user->name }}</h1>
                <p>{{__('profile.Posted')}} {{ $posts->count() }} {{ Str::plural('post', $posts->count()) }} {{__('profile.and')}} 
                {{__('profile.received ')}} {{ $user->receivedLikes->count() }} {{ Str::plural('like', $posts->count()) }}</p>
            </div>

            @if ($user->name == 'Daryn')
                <h1 style="font-size: 30px;">Hi, you are the admin of this site</h1>
            @endif

            <div class="bg-white p-6 rounded-lg">
            @if ($posts -> count())
                @foreach ($posts as $post)
                <div class="mb-4">
                        <a href="{{ route('users.posts', $post->user) }}" class="font-bold">{{ $post->user->name }}</a>
                        <span class="text-gray-600 text-sm">{{ $post->created_at->diffForHumans() }}</span>
                        <p class="mb-2">{{ $post->body }}</p>
                        
                        @if(Auth::user()->name == 'Daryn' || Auth::user()->name == $post->user->name)
                        <form action="{{ route('posts.destroy', $post) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="button__delete" type="submit" class="text-blue-500">{{__('profile.Delete')}}</button>
                        </form>
                        @endif
                        
                        <div class="flex items-center">
                            @auth
                            @if(!$post->likedBy(auth()->user()))
                                <form action="{{ route('posts.likes', $post) }}" method="post" class="mr-1">
                                    @csrf
                                    <button class="button__like" type="submit" class="text-blue-500">{{__('profile.Like')}}</button>
                                </form>
                            @else
                                <form action="{{ route('posts.likes', $post) }}" method="post" class="mr-1">
                                    @csrf
                                    @method('DELETE')
                                    <button class="button__unlike" type="submit" class="text-blue-500">{{__('profile.Unlike')}}</button>
                                </form>
                            @endif
                            
                            @endauth
                            <span>{{ $post->likes->count() }} {{ Str::plural('like', $post->likes->count()) }}</span>
                        </div>
                    </div>
                @endforeach
                {{ $posts->links() }}
            @else
                <p>{{ $user->name }} {{__('profile.does not have any posts')}}</p>
            @endif
            </div>
        </div> 
    </div>
@endsection