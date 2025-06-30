@extends('layouts.app')

@section('title', 'Statistiques des visites')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white rounded-xl shadow-md">
    <h1 class="text-2xl font-bold text-gray-800 mb-4">Statistiques des visites</h1>

    <form method="GET" class="mb-6 flex items-center gap-4">
        <label for="date" class="text-sm font-medium text-gray-700">Filtrer par jour :</label>
        <input type="date" name="date" id="date" value="{{ $date }}" class="border border-gray-300 rounded-lg px-3 py-2 shadow-sm focus:ring focus:ring-indigo-200">
        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition">Filtrer</button>
    </form>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div class="p-4 bg-blue-50 rounded shadow text-center">
            <h2 class="text-lg font-semibold text-blue-700">Total des visiteurs</h2>
            <p class="text-2xl font-bold">{{ $total }}</p>
        </div>
        <div class="p-4 bg-yellow-50 rounded shadow text-center">
            <h2 class="text-lg font-semibold text-yellow-700">Présents</h2>
            <p class="text-2xl font-bold">{{ $presents }}</p>
        </div>
        <div class="p-4 bg-green-50 rounded shadow text-center">
            <h2 class="text-lg font-semibold text-green-700">Partis</h2>
            <p class="text-2xl font-bold">{{ $partis }}</p>
        </div>
        <div class="p-4 bg-red-50 rounded shadow text-center">
            <h2 class="text-lg font-semibold text-red-700">Bannis</h2>
            <p class="text-2xl font-bold">{{ $bannis }}</p>
        </div>
    </div>
</div>
@endsection
