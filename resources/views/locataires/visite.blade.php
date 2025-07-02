@extends('layouts.locataire')
@section('title','Mes visiteurs')
@section('content')
<section>
            <h2 class="text-xl font-semibold text-center text-gray-800 mb-4  "> Visiteurs enregistrés</h2>
            @if($locataire->visiteurs->isEmpty())
                <div class="bg-blue-100 text-blue-800 px-4 py-3 rounded shadow-sm">
                    Aucun visiteur enregistré pour ce locataire.
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class=" border border-gray-100 min-w-full  text-sm">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="border border-gray-100 py-6 py-3 text-center font-bold text-gray-600 upprercase"> Photo visiteur</th>
                                <th class="border border-gray-100 px-6 py-3 text-center font-semibold text-gray-600 uppercase">Nom</th>
                                <th class="border border-gray-100 px-6 py-3 text-center font-semibold text-gray-600 uppercase">Prénom</th>
                                <th class="border border-gray-100 px-6 py-3 text-center font-semibold text-gray-600 uppercase">Date</th>
                                <th class="border border-gray-100 px-6 py-3 text-center font-semibold text-gray-600 uppercase">Motif</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white ">
                            @foreach($locataire->visiteurs as $visiteur)
                            <tr class="hover:bg-yellow-100 transition">
                                <td class="border border-gray-100 py-6 py-3  px-6 py-4">
                                    @if($visiteur->photo_visiteur)
                                        <img class=" mx-auto object-cober rounded-full  w-10 h-10" src="{{asset('storage/' . $visiteur->photo_visiteur)}}" alt="Photo de {{$visiteur->nom}} {{$visiteur->prenom }}">
                                    @else
                                    <div class="">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                    @endif

                                </td>

                                <td class="border border-gray-100 py-6 py-3 text-center  px-6 py-4">{{ $visiteur->nom }}</td>
                                <td class="border border-gray-100 py-6 py-3 text-center px-6 py-4">{{ $visiteur->prenom }}</td>
                                <td class="border border-gray-100 py-6 py-3 text-center px-6 py-4">
                                    {{ \Carbon\Carbon::parse($visiteur->date)->format('d/m/Y' ) }}
                                </td>
                                <td class="border border-gray-100 py-6 py-3 text-center px-6 py-4">{{ $visiteur->motif }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </section>

@endsection