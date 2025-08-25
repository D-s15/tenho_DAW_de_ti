@extends('layouts.app')

@section('content')

<form action="{{ route('users.login') }}" method="POST" class="max-w-md mx-auto bg-white p-6 rounded shadow">

    @csrf
    <label for="username">username:</label>
    <br>
    <input type="text" name="username" id="username" placeholder="Username" class="border border-gray-400 rounded px-2 py-1 outline-none">
    <br> <br>

    <label for="password">password:</label>
    <br>
    <input type="password" name="password" id="password" placeholder="Password" class="border border-gray-400 rounded px-2 py-1 outline-none"> 
    <br> <br>
    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Login</button>
    <p class="mt-2">Don't have an account? <a href="{{ route('users.register') }}" class="text-blue-500">Register here</a></p>

</form>

@if ($errors->any())
    <div class="bg-red-200 text-red-700 p-2 rounded mb-4">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('success'))
    <div class="bg-green-200 text-green-700 p-2 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

@endsection