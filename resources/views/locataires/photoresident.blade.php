@extends('layouts.app')

@section('title', 'Photo du resident')

@section('content')
<div class="flex flex-col items-center justify-center min-h-screen bg-gray-100 py-12">
    <h1 class="text-2xl font-bold text-indigo-700 mb-6">Photo du resident : {{ $locataire->nom }} {{ $locataire->prenom }}</h1>

    @if($locataire->photo)
        <img src="{{ asset('storage/' . $locataire->photo) }}"
             alt="Photo du resident"
             class="max-w-2xl w-full rounded-lg shadow-lg border border-gray-300">
    @else
        <p class="text-gray-500">Aucune photo disponible.</p>
    @endif

    <a href="{{ route('locataires.index') }}" class="mt-6 text-indigo-600 hover:underline">← Retour à la liste</a>
</div>
@endsection
