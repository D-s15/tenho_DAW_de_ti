@extends('layouts.app')

@section('content')

<form action="{{route('users.register')}}" method="post">
    
    @csrf
    <label for="name" class="block mt-4 mb-2">Username:</label>
    <input required type="text" name="name" id="name" placeholder="Username" class="border border-gray-400 rounded px-2 py-1 outline-none">

    <label for="email" class="block mb-2">Email:</label>
    <input required type="email" name="email" id="email" placeholder="Email" class="border border-gray-400 rounded px-2 py-1 outline-none">

    <label for="phone" class="block mt-4 mb-2">Phone number:</label>
    <input required type="text" name="phone" id="phone" placeholder="Phone number" class="border border-gray-400 rounded px-2 py-1 outline-none">

    <label for="password" class="block mt-4 mb-2">Password:</label>
    <input required type="password" name="password" id="password" placeholder="Password" class="border border-gray-400 rounded px-2 py-1 outline-none">

    <label for="password_confirmation" class="block mt-4 mb-2">Confirm Password:</label>
    <input required type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password" class="border border-gray-400 rounded px-2 py-1 outline-none">
    <span id="message" class="block mt-2 text-red-500"></span>
    
    <br> <br>
    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded mt-4">Register</button>
    <p class="mt-2">Already have an account? <a href="{{ route('users.login') }}" class="text-blue-500">Login here</a></p>

</form>

@endsection
