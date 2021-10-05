@extends('layouts.app')

@section('content')
  <div class="flex justify-center">
    <div class="w-8/12 bg-gray-400 p-6 rounded-lg shadow-lg">
      <form action="{{ route('posts') }}" method="POST" class="mb-4">
        @csrf
        <div class="mb-4">
          <label for="body" class="sr-only">Body</label>
          <textarea name="body" id="body" cols="30" rows="10" class="bg-gray-200 border-2 w-full p-4 rounded-lg @error('body') border-red-500 @enderror" placeholder="Post something!"></textarea>
          @error('body')
            <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
          @enderror
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded font-medium">Publish</button>
      </form>
        @if ($posts->count())
          @foreach($posts as $post)
            <div class="mb-4">
              <a href="" class="font-bold">{{ $post->user->name }}</a>
              <span class="text-gray-600 text-sm">{{ $post->created_at->diffForHumans() }}</span>
              <p class="mb-2">{{ $post->body }}</p>
              @if ($post->ownedBy(auth()->user()))
                <div>
                  <form action="{{ route('posts.destroy', $post) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-500">Delete</button>
                  </form>
                </div>
              @endif
              <div class="flex items-center">
                @auth
                  @if(!$post->likedBy(auth()->user()))
                    <form action="{{ route('posts.like', $post) }}" method="POST" class="mr-1">@csrf<button type="submit" class="text-blue-500">Like</button></form>
                  @else
                    <form action="{{ route('posts.like', $post) }}" method="post" class="mr-1">@csrf @method('DELETE')<button type="submit" class="text-blue-500">Unlike</button></form>
                  @endif
                @endauth
                <span>{{ $post->likes->count() }} {{ Str::plural('like', $post->likes->count()) }}</span>
              </div>
            </div>
          @endforeach
          {{-- {{ $posts->links() }} --}}
        @else
            <p>There is no post to display.</p>
        @endif
      {{ $posts->links() }}
    </div>
  </div>
@endsection