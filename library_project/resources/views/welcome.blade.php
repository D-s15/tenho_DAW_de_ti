@extends('layouts.app')

@section('content')
        
<div class="grid grid-cols-4 gap-5 max-lg:grid-cols-2 max-sm:grid-cols-1">
    @foreach ($books as $book)
        <div class="bg-gray-800 text-white rounded-lg p-4">
            @if ($book->cover)
                <img src="{{ asset('storage/' . $book->cover) }}" alt="{{ $book->title }}" class="w-full h-auto">
            @endif
            <h3 class="text-lg font-semibold">{{ $book->title }}</h3>
            <p class="text-gray-300">{{ $book->author }}</p>
        </div>
    @endforeach
</div>    

@endsection
