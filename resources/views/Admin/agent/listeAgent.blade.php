@extends('layouts.admin')

@section('title', 'Liste des agents')

@section('content')
<div class="max-w-4xl mx-auto bg-white shadow rounded p-6">
    <h1 class="text-2xl font-bold mb-6">Liste des agents</h1>

    <table class="min-w-full bg-white text-sm border border-gray-300">
        <thead class="bg-purple-100">
            <tr>
                <th class=" border border-gray-200 px-4 py-2 text-center text-sm ">Nom</th>
                <th class=" border border-gray-200 px-4 py-2 text-center text-sm ">Prénom</th>
                <th class=" border border-gray-200 px-4 py-2 text-center text-sm ">Email</th>
                <th class=" border border-gray-200 px-4 py-2 text-center text-sm ">Téléphone</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($agents as $agent)
                <tr class="hover:bg-gray-50">
                    <td class=" border border-gray-200  text-center text-sm px-4 py-2  uppercase">{{ $agent->nom }}</td>
                    <td class=" border border-gray-200 text-center text-sm px-4 py-2  ">{{ $agent->prenom }}</td>
                    <td class="  border border-gray-200 text-center text-sm px-4 py-2 ">{{ $agent->email }}</td>
                    <td class=" border border-gray-200 text-center text-sm px-4 py-2 ">{{ $agent->telephone }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class=" border border-gray-200 text-center text-gray-500 py-4">Aucun agent trouvé.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
