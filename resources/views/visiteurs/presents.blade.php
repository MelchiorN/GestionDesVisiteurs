@extends('layouts.app')
@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-center items-center mb-10">
        <h1 class="text-2xl font-bold text-center">Visiteurs sur place</h1>
    </div>
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class=" border min-w-full divide-y divide-gray-200">
                <thead class="bg-indigo-50">
                    <tr>
                        <th scope="col" class=" border py-4 text-center text-[15px] font-medium text-bold uppercase ">Visiteur</th>
                        <th scope="col" class=" border py-4 text-center text-[15px]  font-medium text-bold uppercase ">Locataire visité</th>
                        <th scope="col" class=" border  py-4 text-center  text-[15px] font-medium text-bold uppercase ">Localisation locataire</th>
                        <th scope="col" class=" border py-4 text-center  text-[15px]  font-medium text-bold uppercase ">Heure arrivée</th>
                        <th scope="col" class="border py-4 text-center text-[15px]  font-medium text-bold uppercase ">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($visiteurs as $visiteur)
                    <tr>
                        <td class=" border py-4 text-center whitespace-normal">{{ $visiteur->nom }} {{ $visiteur->prenom }}  </td>                 
                        <td class="border py-4 text-center  whitespace-normal">
                            <div class=" text-gray-900 text-[15px]">{{ $visiteur->locataire->nom }} {{ $visiteur->locataire->prenom }}</div>
                            <div class=" text-gray-500 text-base">{{ $visiteur->locataire->telephone }}</div>
                        </td>
                        <td class=" border py-4 text-center  whitespace-normal">
                            <span class="px-2 inline-flex text-[15px] leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                Étage {{ $visiteur->locataire->numero_etage }} - Ch. {{ $visiteur->locataire->numero_chambre }}
                            </span>
                        </td>
                        <td class=" border py-4 text-center text-[15px]whitespace-normal text-sm text-gray-500">
                            {{ date('H:i', strtotime($visiteur->heure_arrive)) }}
                        </td>
                        
                        <td class=" border  px-6 py-4 text-center  whitespace-normal text-center text-sm font-medium">
                            <form method="POST" action="{{ route('visiteurs.depart', $visiteur) }}" class="inline text-center">
                                @csrf
                                <button type="submit" class=" flex  gap-2 items-center text-green-600 hover:text-green-900 hover:bg-green-50 px-4 py-2 rounded-full  transition">
                                    <i class="fa fa-check" aria-hidden="true"></i>
                                    <span>Terminer la visite</span>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach    
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection