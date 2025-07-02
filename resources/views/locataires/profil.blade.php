@extends('layouts.locataire')

@section('title', 'Mon Profil')

@section('content')
<div class="max-w-4xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
    <div class="bg-white shadow-xl rounded-lg p-8">
        <h2 class="text-3xl font-extrabold text-gray-900 mb-6 text-center">Mon Profil</h2>

        <div class="flex flex-col md:flex-row items-center md:items-start space-y-6 md:space-y-0 md:space-x-8">
            <div class="flex-shrink-0">
                @if($locataire->photo)
                    <img class="object-cover rounded-full w-32 h-32 border-4 border-indigo-200 shadow-md"
                         src="{{ asset('storage/' . $locataire->photo) }}"
                         alt="Photo de {{ $locataire->nom }}">
                @else
                    <div class="w-32 h-32 rounded-full bg-gray-100 flex items-center justify-center border-4 border-gray-200 text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                @endif
            </div>

            
            <div class="flex-grow text-center md:text-left">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-4">
                    <p class="text-gray-700">
                        <strong class="font-semibold text-gray-900">Nom :</strong>
                        <span class="ml-2">{{ $locataire->nom }}</span>
                    </p>
                    <p class="text-gray-700">
                        <strong class="font-semibold text-gray-900">Prénom :</strong>
                        <span class="ml-2">{{ $locataire->prenom }}</span>
                    </p>
                    <p class="text-gray-700">
                        <strong class="font-semibold text-gray-900">Email :</strong>
                        <span class="ml-2">{{ $locataire->email }}</span>
                    </p>
                    <p class="text-gray-700">
                        <strong class="font-semibold text-gray-900">Téléphone :</strong>
                        <span class="ml-2">{{ $locataire->telephone  }}</span>
                    </p>
                    <p class="text-gray-700">
                        <strong class="font-semibold text-gray-900">Type de résident :</strong>
                        <span class="ml-2">{{ ucfirst($locataire->type_resident) }}</span>
                    </p>
                    <p class="text-gray-700">
                        <strong class="font-semibold text-gray-900">Étage :</strong>
                        <span class="ml-2">{{ $locataire->numero_etage  }}</span>
                    </p>
                    <p class="text-gray-700">
                        <strong class="font-semibold text-gray-900">Numéro de chambre :</strong>
                        <span class="ml-2">{{ $locataire->numero_chambre }}</span>
                    </p>
                </div>

                <!-- Modifier son profil -->
                <div class="mt-8 text-center md:text-left">
                    <a href="" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150 ease-in-out">   
                        <i class="fas fa-edit mr-2"></i> <span>Modifier mon profil</span> 
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection