@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg">
            @auth
            <form action="{{ route('posts') }}" method="post" class="mb-4">
            @csrf
                <div class="mb-4">
                    <label for="body" class="sr-only">Body</label>
                    <textarea name="body" id="body" cols="30" rows="4" class="bg-gray-100
                    border-2 w-full p-4 rounded-lg @error('body') border-red-500 @enderror"
                    placeholder="{{__('profile.Post something!')}}"></textarea>
                    @error('body')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded font-medium">{{__('profile.Post')}}</button>
                </div>
            </form>
            @endauth
            
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
                            <button class="button__delete" type="submit">{{__('profile.Delete')}}</button>
                        </form>
                        @endif

                        <div class="flex items-center">
                            @auth
                            @if(!$post->likedBy(auth()->user()))
                                <form action="{{ route('posts.likes', $post) }}" method="post" class="mr-1">
                                    @csrf
                                    <button class="button__like" type="submit">{{__('profile.Like')}}</button>
                                </form>
                            @else
                                <form action="{{ route('posts.likes', $post) }}" method="post" class="mr-1">
                                    @csrf
                                    @method('DELETE')
                                    <button class="button__unlike" type="submit">{{__('profile.Unlike')}}</button>
                                </form>
                            @endif
                            
                            @endauth
                            <span>{{ $post->likes->count() }} {{ Str::plural('like', $post->likes->count()) }}</span>
                        </div>
                    </div>
                @endforeach
                {{ $posts->links() }}
            @else
                <p>There are no posts</p>
            @endif
        </div> 
    </div>
@endsection