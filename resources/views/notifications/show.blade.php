@extends('layouts.app')

@section('title', 'Détail du visiteur')

@section('content')
<div class="max-w-3xl mx-auto bg-white rounded-xl shadow-lg p-8 mt-10">
    <h1 class="text-2xl font-bold text-indigo-700 mb-6">👤 Détails du visiteur</h1>

    <div class="mb-6 space-y-2 text-gray-700">
        <p><strong>Nom :</strong> {{ $visiteur->nom }}</p>
        <p><strong>Prénom :</strong> {{ $visiteur->prenom }}</p>
        <p><strong>CNI :</strong> {{ $visiteur->cni }}</p>
        <p><strong>Date :</strong> {{ $visiteur->date }}</p>
        <p><strong>Heure d’arrivée :</strong> {{ $visiteur->heure_arrive }}</p>
        <p><strong>Motif :</strong> {{ $visiteur->motif }}</p>
    </div>

    <!-- Formulaire de décision -->
    <form action="{{ route('notifications.action', $notification->id) }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label for="message" class="block font-semibold text-sm mb-1">Message pour le visiteur :</label>
            <textarea name="message" id="message" rows="3" required
                      class="w-full border px-4 py-2 rounded-md"></textarea>
        </div>

        <div class="flex gap-4">
            <button type="submit" name="action" value="accepter"
                    class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                ✅ Accepter
            </button>
            <button type="submit" name="action" value="refuser"
                    class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
                ❌ Refuser
            </button>
            <button type="submit" name="action" value="bannir"
                    class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                🚫 Bannir
            </button>
        </div>
    </form>
</div>
@endsection
