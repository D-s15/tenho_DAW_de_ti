@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto bg-white p-6 rounded shadow mt-10">
    <h1 class="text-2xl font-bold mb-4">Perfil do Utilizador</h1>

    <!-- Foto de perfil -->
    <div class="flex justify-center mb-6">
        @if(Auth::guard('library')->user()->profile_image ?? false)
            <img src="{{ Auth::guard('library')->user()->profile_image }}" alt="Foto de Perfil" class="w-32 h-32 rounded-full object-cover">
        @else
            <div class="w-32 h-32 rounded-full bg-gray-300 flex items-center justify-center text-gray-600">
                Sem Foto
            </div>
        @endif
    </div>

    <!-- Dados do utilizador -->
    <div class="space-y-4">
        <div>
            <span class="font-semibold">Nome de utilizador:</span>
            <span>{{ Auth::guard('library')->user()->username }}</span>
        </div>
        <div>
            <span class="font-semibold">Email:</span>
            <span>{{ Auth::guard('library')->user()->email }}</span>
        </div>
        <div>
            <span class="font-semibold">Telefone:</span>
            <span>{{ Auth::guard('library')->user()->phone ?? 'Não definido' }}</span>
        </div>
    </div>

    <!-- Botão de editar perfil (opcional) -->
    <div class="mt-6">
        <a href="#" class="bg-blue-500 text-white px-4 py-2 rounded">Editar Perfil</a>
    </div>
</div>
@endsection
