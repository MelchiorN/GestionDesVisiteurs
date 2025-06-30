@extends('layouts.app')

@section('title', 'Photo du visiteur')

@section('content')
<div class="flex flex-col items-center justify-center min-h-screen bg-gray-100 py-12">
    <h1 class="text-2xl font-bold text-indigo-700 mb-6">Photo du visiteur : {{ $visiteur->nom }} {{ $visiteur->prenom }}</h1>

    @if($visiteur->photo_visiteur)
        <img src="{{ asset('storage/' . $visiteur->photo_visiteur) }}"
             alt="Photo du visiteur"
             class="max-w-2xl w-full rounded-lg shadow-lg border border-gray-300">
    @else
        <p class="text-gray-500">Aucune photo disponible.</p>
    @endif

    <a href="{{ route('visiteurs.filtre') }}" class="mt-6 text-indigo-600 hover:underline">← Retour à la liste</a>
</div>
@endsection
