@extends('layouts.app')
@section('content')
    <main>
        <div class="book-grid">
            <div class="book"></div>
            <div class="book"></div>
            <div class="book"></div>
            <div class="book"></div>
            <div class="book"></div>
            <div class="book"></div>
            <div class="book"></div>
            <div class="book"></div>
        </div>
    </main>
        @if (Route::has('login'))
            <div class="h-14.5 hidden lg:block"></div>
        @endif

        