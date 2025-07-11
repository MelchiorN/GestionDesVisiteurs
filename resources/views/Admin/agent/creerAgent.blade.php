@extends('layouts.admin')

@section('title', 'Créer un agent')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-8 rounded-xl shadow mt-10">
    <h1 class="text-2xl font-bold mb-6 text-center text-purple-800">Créer un nouvel agent</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.store.agent') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2" for="nom">Nom</label>
            <input type="text" name="nom" id="nom" value="{{ old('nom') }}" required class="w-full border border-gray-300 px-4 py-2 rounded">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2" for="prenom">Prénom</label>
            <input type="text" name="prenom" id="prenom" value="{{ old('prenom') }}" required class="w-full border border-gray-300 px-4 py-2 rounded">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2" for="telephone">Téléphone</label>
            <input type="text" name="telephone" id="telephone" value="{{ old('telephone') }}" required class="w-full border border-gray-300 px-4 py-2 rounded">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2" for="email">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required class="w-full border border-gray-300 px-4 py-2 rounded">
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 font-semibold mb-2" for="password">Mot de passe</label>
            <input type="password" name="password" id="password" required class="w-full border border-gray-300 px-4 py-2 rounded">
        </div>

        <div class="text-center">
            <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-6 rounded transition">
                Créer l'agent
            </button>
        </div>
    </form>
</div>
@endsection
