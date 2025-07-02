@extends('layouts.locataire')
@section('title','Mes notificvations')
@section('content')
<div class="max-w-4xl mx-auto bg-white rounded-xl shadow-md overflow-hidden mt-10">
    <div class="bg-indigo-700 px-6 py-4">
        <h1 class="text-2xl font-bold text-white">Notifications pour {{ $locataire->nom }} {{ $locataire->prenom }}</h1>
    </div>

    <div class="p-6">
        @forelse($notifications as $notification)
            @php
                $data = is_array($notification->data) ? $notification->data : json_decode($notification->data, true);
            @endphp

            <div class="mb-6 p-4 border rounded-lg shadow-sm hover:shadow-md transition-shadow">
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="font-semibold text-lg">
                            Nouveau visiteur : {{ $data['nom'] }} {{ $data['prenom']}}
                        </h3>
                        <p class="text-gray-600">Motif : {{ $data['motif'] }}</p>
                        <p class="text-sm text-gray-500">
                            Arrivé le {{ \Carbon\Carbon::parse($notification->created_at)->format('d/m/Y à H:i') }}
                        </p>
                    </div>
                    @if(!$notification->read_at)
                        <span class="bg-red-100 text-red-800 text-xs px-2 py-1 rounded-full">Nouveau</span>
                    @endif
                </div>

                <div class="mt-4 pt-4 border-t">
                    <form method="POST" action="{{ route('notif.reponse', $notification->id) }}" class="space-y-3">
                        @csrf
                        <input type="hidden" name="locataire_id" value="{{ $locataire->id }}">

                        <div>
                            <label for="message-{{ $notification->id }}" class="block text-sm font-medium text-gray-700">
                                Message 
                            </label>
                            <textarea id="message-{{ $notification->id }}" name="message" rows="2"
                                      class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm"></textarea>
                        </div>

                        <div class="flex space-x-3">
                            <button type="submit" name="action" value="accept"
                                    class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                                Accepter
                            </button>
                            <button type="submit" name="action" value="refuse"
                                    class="bg-yellow-600 text-white px-4 py-2 rounded hover:bg-yellow-700">
                                Refuser
                            </button>
                            <button type="submit" name="action" value="ban"
                                    class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                                Bannir
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @empty
            <div class="text-center py-8 text-gray-500">
                Aucune notification pour ce résident.
            </div>
        @endforelse
    </div>
</div>

@endsection