@extends('layouts.app')

@section('content')
  <div class="flex justify-center">
    <div class="w-8/12">
      <div class="p-6 bg-gray-400 p-6 rounded-lg mb-4">
        <h1 class="text-2xl font-medium mb-1">{{ $user->name }}</h1>
        <p>Posted <span class="font-bold">{{ $posts->count() }}</span> {{ Str::plural('post', $posts->count()) }} and achieved <span class="font-bold">{{ $user->Receivedlikes->count() }}</span> likes so far.</p>
      </div>

      <div class="bg-gray-400 p-6 rounded-lg">
        @if ($posts->count())
          @foreach($posts as $post)
            <x-post :post="$post" />
          @endforeach
        {{-- {{ $posts->links() }} --}}
        @else
          <p>There is no post to display.</p>
          {{ $posts->links() }}
        @endif
      </div>
    </div>
  </div>
@endsection