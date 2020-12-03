@extends('layout.app')
@section('content')
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg">
            <form action="{{ route('posts') }}" method="post" class="mb-4">
                @csrf
                <div class="mb-4">
                    <label for="body" class="sr-only">Body</label>
                    <textarea name="body" id="body" cols="30" rows="4" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('body') border-red-500 @enderror" placeholder="Post somthing!"></textarea>
                    @error('body')
                        <div class="text-red-500 mt-2 text-sm">{{ $message  }}</div>
                    @enderror
                </div>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-4 p-3 rounded">
                    Post
                </button>
            </form>
            @if($posts->count())
                @foreach($posts as $post)
                    <div class="mb-4">
                        <a class="font-bold pr-3">{{ $post->user->name }}</a><sapn class="text-grey-600 text-sm">{{ $post->created_at }}</sapn>
                        <p class="mb-2">{{ $post->body }}</p>
                        <div class="flex items-center">
                            @if(!$post->likeBy(auth()->user()))
                                <form action="{{ route('post.like',$post->id) }}" method="post" class="mr-1">
                                    @csrf
                                    <button type="submit" class="text-blue-500 pr-3">Like</button>
                                </form>
                            @else
                                <form action="" method="post" class="mr-1">
                                    @csrf
                                    <button type="submit" class="text-blue-500 pr-3">Unlike</button>
                                </form>
                            @endif
                            <span>{{ $posts->count() }} {{ Str::plural('like',$posts->count()) }}</span>
                        </div>
                    </div>
                @endforeach
                {{ $posts->links() }}
            @else
                <p>helo</p>
            @endif
        </div>
    </div>
@endsection
